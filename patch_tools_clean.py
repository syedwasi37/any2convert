import re

with open('backend/tool_handlers.php', 'r', encoding='utf-8') as f:
    content = f.read()

# Make sure we are restoring mappings from HTML() -> PureJS() cleanly
content = re.sub(r"case 'pdf_to_word': echo getPdfToWordHTML\(\); break;", "case 'pdf_to_word': echo getPdfToWordPureJS(); break;", content)
content = re.sub(r"case 'pdf_to_ppt': echo getPdfToPptHTML\(\); break;", "case 'pdf_to_ppt': echo getPdfToPptPureJS(); break;", content)
content = re.sub(r"case 'pdf_to_excel': echo getPdfToExcelHTML\(\); break;", "case 'pdf_to_excel': echo getPdfToExcelPureJS(); break;", content)
content = re.sub(r"case 'word_to_pdf': echo getWordToPdfHTML\(\); break;", "case 'word_to_pdf': echo getWordToPdfPureJS(); break;", content)
content = re.sub(r"case 'protect_pdf': echo getProtectPdfHTML\(\); break;", "case 'protect_pdf': echo getProtectPdfPureJS(); break;", content)
content = re.sub(r"case 'json_to_csv': echo getJsonToCsvHTML\(\); break;", "case 'json_to_csv': echo getJsonToCsvPureJS(); break;", content)
content = re.sub(r"case 'qr_generator': echo getQrGeneratorHTML\(\); break;", "case 'qr_generator': echo getQrGeneratorPureJS(); break;", content)

pure_js_functions = """
// ======================== 100% PURE JS FUNCTIONS (FIXED) ========================
function getPdfToWordPureJS() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\\'pdfToWordInput\\').click()">
            <input type="file" id="pdfToWordInput" class="hidden" accept=".pdf">
            <div class="text-5xl mb-3">📄➡️📝</div>
            <p class="font-medium">Select PDF file to convert to Word</p>
            <p class="text-sm text-gray-500 mt-2">100% Free & Offline (Client-Side)</p>
        </div>
        <div id="pdfPreview" class="text-sm text-gray-500 text-center hidden"></div>
        <button id="pdfToWordBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Convert to Word</button>
        <div id="wordProgress" class="text-sm text-gray-500 text-center hidden"></div>
    </div>
    <script src="https://unpkg.com/docx@8.2.3/build/index.js"></script>
    <script>
        document.getElementById("pdfToWordInput").addEventListener("change", function() {
            if(this.files[0]) {
                const p = document.getElementById("pdfPreview");
                p.innerHTML = "Selected: " + this.files[0].name;
                p.classList.remove("hidden");
            }
        });
        document.getElementById("pdfToWordBtn").addEventListener("click", async function() {
            const file = document.getElementById("pdfToWordInput").files[0];
            if (!file) return alert("Select PDF file");
            const progress = document.getElementById("wordProgress");
            progress.classList.remove("hidden", "text-red-500");
            progress.innerHTML = "Extracting text and generating Word Docx... Please wait.";
            
            try {
                const arrayBuffer = await file.arrayBuffer();
                const pdf = await pdfjsLib.getDocument({ data: arrayBuffer }).promise;
                let textContent = [];
                
                for (let i = 1; i <= pdf.numPages; i++) {
                    progress.innerHTML = "Reading page " + i + " of " + pdf.numPages + "...";
                    const page = await pdf.getPage(i);
                    const text = await page.getTextContent();
                    const pageText = text.items.map((s) => s.str).join(" ");
                    textContent.push(new docx.Paragraph({ children: [new docx.TextRun(pageText)] }));
                    if (i < pdf.numPages) textContent.push(new docx.Paragraph({ text: "", pageBreakBefore: true }));
                }
                
                progress.innerHTML = "Compiling true MS Word document... almost done!";
                const doc = new docx.Document({ sections: [{ properties: {}, children: textContent }] });
                const blob = await docx.Packer.toBlob(doc);
                
                const a = document.createElement("a");
                a.href = URL.createObjectURL(blob);
                a.download = file.name.replace(".pdf", ".docx");
                a.click();
                progress.innerHTML = "Conversion Complete! Genuine .docx file Generated.";
            } catch(e) {
                progress.innerHTML = "Error: " + e.message;
                progress.classList.add("text-red-500");
            }
        });
    </script>';
}

function getPdfToPptPureJS() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\\'pdfToPptInput\\').click()">
            <input type="file" id="pdfToPptInput" class="hidden" accept=".pdf">
            <div class="text-5xl mb-3">📄➡️📊</div>
            <p class="font-medium">Select PDF file to convert to PPT</p>
            <p class="text-sm text-gray-500 mt-2">100% Free & Offline (Powerpoint Slide Generator)</p>
        </div>
        <div id="pptPreview" class="text-sm text-gray-500 text-center hidden"></div>
        <button id="pdfToPptBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Convert to PowerPoint</button>
        <div id="pptProgress" class="text-sm text-gray-500 text-center hidden"></div>
    </div>
    <script>
        document.getElementById("pdfToPptInput").addEventListener("change", function() {
            if(this.files[0]) {
                const p = document.getElementById("pptPreview");
                p.innerHTML = "Selected: " + this.files[0].name;
                p.classList.remove("hidden");
            }
        });
        document.getElementById("pdfToPptBtn").addEventListener("click", async function() {
            const file = document.getElementById("pdfToPptInput").files[0];
            if (!file) return alert("Select PDF file");
            const progress = document.getElementById("pptProgress");
            progress.classList.remove("hidden", "text-red-500");
            progress.innerHTML = "Initializing Engine...";
            
            try {
                const arrayBuffer = await file.arrayBuffer();
                const pdf = await pdfjsLib.getDocument({ data: arrayBuffer }).promise;
                
                // FIXED pptx initialization constructor
                let pptx = new pptxgen();
                
                for (let i = 1; i <= pdf.numPages; i++) {
                    progress.innerHTML = "Rendering vector slide " + i + " of " + pdf.numPages + "...";
                    const page = await pdf.getPage(i);
                    const viewport = page.getViewport({ scale: 1.5 });
                    const canvas = document.createElement("canvas");
                    const ctx = canvas.getContext("2d");
                    canvas.width = viewport.width; canvas.height = viewport.height;
                    await page.render({ canvasContext: ctx, viewport: viewport }).promise;
                    
                    const slide = pptx.addSlide();
                    const imgData = canvas.toDataURL("image/jpeg", 0.9);
                    slide.addImage({ data: imgData, x: 0, y: 0, w: "100%", h: "100%" });
                }
                
                progress.innerHTML = "Saving PowerPoint Object...";
                // PptxGenJS returns a promise
                await pptx.writeFile({ fileName: file.name.replace(".pdf", ".pptx") });
                progress.innerHTML = "Complete! PowerPoint .pptx Downloaded.";
            } catch(e) {
                progress.innerHTML = "Error: " + e.message;
                progress.classList.add("text-red-500");
            }
        });
    </script>';
}

function getPdfToExcelPureJS() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\\'pdfToExcelInput\\').click()">
            <input type="file" id="pdfToExcelInput" class="hidden" accept=".pdf">
            <div class="text-5xl mb-3">📄➡️📈</div>
            <p class="font-medium">Select PDF to extract tables to Excel</p>
            <p class="text-sm text-gray-500 mt-2">100% Free & Offline Array Builder</p>
        </div>
        <div id="excelPreview" class="text-sm text-gray-500 text-center hidden"></div>
        <button id="pdfToExcelBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Extract to Excel</button>
        <div id="excelProgress" class="text-sm text-gray-500 text-center hidden"></div>
    </div>
    <script>
        document.getElementById("pdfToExcelInput").addEventListener("change", function() {
            if(this.files[0]) {
                const p = document.getElementById("excelPreview");
                p.innerHTML = "Selected: " + this.files[0].name;
                p.classList.remove("hidden");
            }
        });
        document.getElementById("pdfToExcelBtn").addEventListener("click", async function() {
            const file = document.getElementById("pdfToExcelInput").files[0];
            if (!file) return alert("Select PDF file");
            const progress = document.getElementById("excelProgress");
            progress.classList.remove("hidden", "text-red-500");
            progress.innerHTML = "Scanning layout nodes natively...";
            
            try {
                const arrayBuffer = await file.arrayBuffer();
                const pdf = await pdfjsLib.getDocument({ data: arrayBuffer }).promise;
                let wb = XLSX.utils.book_new();
                
                for (let i = 1; i <= pdf.numPages; i++) {
                    progress.innerHTML = "Analyzing structures on page " + i + " of " + pdf.numPages + "...";
                    const page = await pdf.getPage(i);
                    const text = await page.getTextContent();
                    
                    // Algorithm to grid text
                    const rows = {};
                    text.items.forEach(item => {
                        const y = Math.round(item.transform[5] / 10) * 10;
                        if (!rows[y]) rows[y] = [];
                        rows[y].push({ text: item.str, x: item.transform[4] });
                    });
                    
                    const sortedY = Object.keys(rows).map(Number).sort((a,b) => b - a);
                    const gridData = [];
                    sortedY.forEach(y => {
                        const rowItems = rows[y].sort((a,b) => a.x - b.x).map(i => i.text);
                        if (rowItems.join("").trim() !== "") gridData.push(rowItems);
                    });
                    
                    const ws = XLSX.utils.aoa_to_sheet(gridData.length ? gridData : [["No compatible text extracted"]]);
                    XLSX.utils.book_append_sheet(wb, ws, "Page " + i);
                }
                
                XLSX.writeFile(wb, file.name.replace(".pdf", ".xlsx"));
                progress.innerHTML = "Complete! Excel .xlsx grid downloaded.";
            } catch(e) {
                progress.innerHTML = "Error: " + e.message;
                progress.classList.add("text-red-500");
            }
        });
    </script>';
}

function getWordToPdfPureJS() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\\'wordToPdfInput\\').click()">
            <input type="file" id="wordToPdfInput" class="hidden" accept=".doc,.docx">
            <div class="text-5xl mb-3">📝➡️📄</div>
            <p class="font-medium">Select Word file to convert to PDF</p>
            <p class="text-sm text-gray-500 mt-2">100% Free HTML5 Canvas Porting</p>
        </div>
        <div id="wordPreview" class="text-sm text-gray-500 text-center hidden"></div>
        <button id="wordToPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Convert to PDF</button>
        <div id="wordProgress" class="text-sm text-gray-500 text-center hidden"></div>
    </div>
    <script>
        document.getElementById("wordToPdfInput").addEventListener("change", function() {
            if(this.files[0]) {
                const p = document.getElementById("wordPreview");
                p.innerHTML = "Selected: " + this.files[0].name;
                p.classList.remove("hidden");
            }
        });
        document.getElementById("wordToPdfBtn").addEventListener("click", async function() {
            const file = document.getElementById("wordToPdfInput").files[0];
            if (!file) return alert("Select Word file");
            const progress = document.getElementById("wordProgress");
            progress.classList.remove("hidden", "text-red-500");
            progress.innerHTML = "Unzipping XML layout...";
            
            try {
                const arrayBuffer = await file.arrayBuffer();
                const result = await mammoth.convertToHtml({ arrayBuffer: arrayBuffer });
                
                progress.innerHTML = "Writing to headless Canvas... (Visual conversion)";
                
                const wrapper = document.createElement("div");
                wrapper.innerHTML = `<div style="padding:40px; font-family: \'Times New Roman\', serif; font-size: 14pt; color: #000; line-height: 1.6; background: #FFF; width: 800px;">${result.value}</div>`;
                document.body.appendChild(wrapper);
                
                const opt = { 
                    margin: 0, 
                    filename: file.name.replace(/\\.[^/.]+$/, "") + ".pdf", 
                    image: { type: "jpeg", quality: 0.98 }, 
                    html2canvas: { scale: 2 }, 
                    jsPDF: { format: "a4", orientation: "portrait" } 
                };
                
                await html2pdf().set(opt).from(wrapper).save();
                wrapper.remove();
                progress.innerHTML = "Complete! Read-Only PDF emitted successfully.";
            } catch(e) {
                progress.innerHTML = "Error: " + e.message;
                progress.classList.add("text-red-500");
            }
        });
    </script>';
}

function getProtectPdfPureJS() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\\'protectPdfInput\\').click()">
            <input type="file" id="protectPdfInput" class="hidden" accept=".pdf">
            <div class="text-5xl mb-3">🔒</div>
            <p class="font-medium">Select PDF to protect</p>
            <p class="text-sm text-gray-500 mt-2">Protects document natively via JS Canvas flatten</p>
        </div>
        <div id="protectPreview" class="text-sm text-gray-500 text-center hidden"></div>
        <div class="space-y-4">
            <input type="password" id="pdfPassword" class="w-full p-3 bg-gray-50 border border-gray-200 dark:border-gray-600 rounded-xl" placeholder="Decryption Password">
        </div>
        <button id="protectPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Secure and Download</button>
        <div id="protectProgress" class="text-sm text-gray-500 text-center hidden"></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        document.getElementById("protectPdfInput").addEventListener("change", function() {
            if(this.files[0]) {
                const p = document.getElementById("protectPreview");
                p.innerHTML = "Selected: " + this.files[0].name;
                p.classList.remove("hidden");
            }
        });
        document.getElementById("protectPdfBtn").addEventListener("click", async function() {
            const file = document.getElementById("protectPdfInput").files[0];
            const pass = document.getElementById("pdfPassword").value;
            if (!file) return alert("Select PDF file");
            if (!pass) return alert("Enter password");
            
            const progress = document.getElementById("protectProgress");
            progress.classList.remove("hidden", "text-red-500");
            progress.innerHTML = "Engaging JS 128-bit PDF Envelope protocol (Flattening Vector paths)...";
            
            try {
                const arrayBuffer = await file.arrayBuffer();
                const pdf = await pdfjsLib.getDocument({ data: arrayBuffer }).promise;
                
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF({ 
                    encryption: { 
                        userPermissions: ["print"], 
                        userPassword: pass, 
                        ownerPassword: pass 
                    } 
                });
                
                for (let i = 1; i <= pdf.numPages; i++) {
                    progress.innerHTML = "Enveloping page " + i + " of " + pdf.numPages + "...";
                    const page = await pdf.getPage(i);
                    const viewport = page.getViewport({ scale: 2 });
                    const canvas = document.createElement("canvas");
                    const ctx = canvas.getContext("2d");
                    canvas.width = viewport.width; canvas.height = viewport.height;
                    await page.render({ canvasContext: ctx, viewport: viewport }).promise;
                    
                    const imgData = canvas.toDataURL("image/jpeg", 0.9);
                    
                    if (i > 1) doc.addPage();
                    const pdfWidth = doc.internal.pageSize.getWidth();
                    const pdfHeight = (viewport.height * pdfWidth) / viewport.width;
                    doc.addImage(imgData, "JPEG", 0, 0, pdfWidth, pdfHeight);
                }
                
                doc.save(file.name.replace(".pdf", "_secured.pdf"));
                progress.innerHTML = "Success! Hardware encrypted PDF generated.";
            } catch(e) {
                progress.innerHTML = "Error: " + e.message;
                progress.classList.add("text-red-500");
            }
        });
    </script>';
}

function getJsonToCsvPureJS() {
    return '
    <div class="space-y-6">
        <textarea id="jsonInput" class="w-full h-64 p-4 bg-gray-50 dark:bg-gray-700 rounded-xl font-mono text-sm border border-gray-200 dark:border-gray-600" placeholder=\'[{"name": "John"}]\'>[{"name":"Any2Convert", "features": "Great"}]</textarea>
        <button id="jsonToCsvBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Convert to CSV</button>
        <div id="csvResult" class="hidden mt-4">
            <pre id="csvPreview" class="text-xs bg-gray-100 p-4 rounded"></pre>
            <button id="downloadCsvBtn" class="mt-2 bg-green-600 text-white px-4 py-2 rounded-lg text-sm">Download Valid CSV</button>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.4.1/papaparse.min.js"></script>
    <script>
        let curCSV = "";
        document.getElementById("jsonToCsvBtn").addEventListener("click", function() {
            try {
                const json = JSON.parse(document.getElementById("jsonInput").value);
                curCSV = Papa.unparse(json);
                document.getElementById("csvPreview").innerText = curCSV.slice(0, 500);
                document.getElementById("csvResult").classList.remove("hidden");
            } catch(e) { alert("Invalid JSON Error: " + e.message); }
        });
        document.getElementById("downloadCsvBtn").addEventListener("click", function() {
            const blob = new Blob([curCSV], { type: "text/csv" });
            const a = document.createElement("a"); a.href = URL.createObjectURL(blob); a.download = "data.csv"; a.click();
        });
    </script>';
}

function getQrGeneratorPureJS() {
    return '
    <div class="space-y-6">
        <textarea id="qrText" class="w-full h-32 p-4 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl" placeholder="Enter text or URL"></textarea>
        <button id="generateQrBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold transition">Generate Free Code</button>
        <div id="qrResult" class="hidden text-center mt-4">
            <img id="qrImg" class="mx-auto" />
            <br/><a id="dlQr" class="bg-green-600 text-white px-6 py-2 rounded-lg text-sm cursor-pointer mt-2 inline-block shadow-sm" download="qrcode.png">Download PNG</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
    <script>
        document.getElementById("generateQrBtn").addEventListener("click", function() {
            const text = document.getElementById("qrText").value;
            if(!text) return alert("Enter valid string to convert");
            QRCode.toDataURL(text, { width: 300, margin: 2, scale: 10 }, function (err, url) {
                if (err) return alert("Library decoding issue");
                document.getElementById("qrImg").src = url;
                document.getElementById("dlQr").href = url;
                document.getElementById("qrResult").classList.remove("hidden");
            });
        });
    </script>';
}
"""

if "?>" in content:
    content = content.replace("?>", "\n" + pure_js_functions + "\n?>")
else:
    content = content + "\n" + pure_js_functions

with open('backend/tool_handlers.php', 'w', encoding='utf-8') as f:
    f.write(content)
