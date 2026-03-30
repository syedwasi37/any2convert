import re

with open('backend/tool_handlers.php', 'r', encoding='utf-8') as f:
    content = f.read()

# Replace switch cases
content = re.sub(r"case 'pdf_to_word': echo getPdfToWordHTML\(\); break;", "case 'pdf_to_word': echo getPdfToWordFixedHTML(); break;", content)
content = re.sub(r"case 'pdf_to_ppt': echo getPdfToPptHTML\(\); break;", "case 'pdf_to_ppt': echo getPdfToPptFixedHTML(); break;", content)
content = re.sub(r"case 'pdf_to_excel': echo getPdfToExcelHTML\(\); break;", "case 'pdf_to_excel': echo getPdfToExcelFixedHTML(); break;", content)
content = re.sub(r"case 'word_to_pdf': echo getWordToPdfHTML\(\); break;", "case 'word_to_pdf': echo getWordToPdfFixedHTML(); break;", content)
content = re.sub(r"case 'protect_pdf': echo getProtectPdfHTML\(\); break;", "case 'protect_pdf': echo getProtectPdfFixedHTML(); break;", content)
content = re.sub(r"case 'json_to_csv': echo getJsonToCsvHTML\(\); break;", "case 'json_to_csv': echo getJsonToCsvFixedHTML(); break;", content)
content = re.sub(r"case 'qr_generator': echo getQrGeneratorHTML\(\); break;", "case 'qr_generator': echo getQrGeneratorFixedHTML(); break;", content)

new_functions = """
// ======================== FIXED FUNCTIONS ========================
function getPdfToWordFixedHTML() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\\'pdfToWordInput\\').click()">
            <input type="file" id="pdfToWordInput" class="hidden" accept=".pdf">
            <div class="text-5xl mb-3">📄➡️📝</div>
            <p class="font-medium">Select PDF file to convert to Word (Server API)</p>
            <p class="text-sm text-gray-500 mt-2">Accurately extract text and layout to DOCX format</p>
        </div>
        <div id="pdfPreview" class="text-sm text-gray-500 text-center hidden"></div>
        <button id="pdfToWordBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Convert to Word</button>
        <div id="wordProgress" class="text-sm text-gray-500 text-center hidden"></div>
    </div>
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
            if (!file) return alert("Please select a PDF file");
            
            const progress = document.getElementById("wordProgress");
            progress.classList.remove("hidden", "text-red-500");
            progress.innerHTML = "Uploading and processing securely via API...";
            
            const formData = new FormData();
            formData.append("file", file);
            formData.append("action", "pdf_to_word");
            
            try {
                const res = await fetch("backend/process_document.php", { method: "POST", body: formData });
                const json = await res.json();
                if (json.error) {
                    progress.innerHTML = "Error: " + json.error;
                    progress.classList.add("text-red-500");
                } else {
                    const a = document.createElement("a");
                    a.href = json.fileData;
                    a.download = json.fileName;
                    a.click();
                    progress.innerHTML = "Conversion complete! Downloaded.";
                }
            } catch(e) {
                progress.innerHTML = "Request failed: " + e.message;
                progress.classList.add("text-red-500");
            }
        });
    </script>';
}

function getPdfToPptFixedHTML() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\\'pdfToPptInput\\').click()">
            <input type="file" id="pdfToPptInput" class="hidden" accept=".pdf">
            <div class="text-5xl mb-3">📄➡️📊</div>
            <p class="font-medium">Select PDF file to convert to PowerPoint (Server API)</p>
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
            if (!file) return alert("Please select a PDF file");
            const progress = document.getElementById("pptProgress");
            progress.classList.remove("hidden", "text-red-500");
            progress.innerHTML = "Processing...";
            const fd = new FormData(); fd.append("file", file); fd.append("action", "pdf_to_ppt");
            try {
                const res = await fetch("backend/process_document.php", { method: "POST", body: fd });
                const json = await res.json();
                if (json.error) { progress.innerHTML = "Error: " + json.error; progress.classList.add("text-red-500"); }
                else {
                    const a = document.createElement("a"); a.href = json.fileData; a.download = json.fileName; a.click();
                    progress.innerHTML = "Complete!";
                }
            } catch(e) { progress.innerHTML = "Error: " + e.message; progress.classList.add("text-red-500"); }
        });
    </script>';
}

function getPdfToExcelFixedHTML() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\\'pdfToExcelInput\\').click()">
            <input type="file" id="pdfToExcelInput" class="hidden" accept=".pdf">
            <div class="text-5xl mb-3">📄➡️📈</div>
            <p class="font-medium">Select PDF to extract tables to Excel (Server API)</p>
        </div>
        <div id="excelPreview" class="text-sm text-gray-500 text-center hidden"></div>
        <button id="pdfToExcelBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Extract to Excel</button>
        <div id="excelProgress" class="text-sm text-gray-500 text-center hidden"></div>
    </div>
    <script>
        document.getElementById("pdfToExcelInput").addEventListener("change", function() {
            if(this.files[0]) {
                document.getElementById("excelPreview").innerHTML = "Selected: " + this.files[0].name;
                document.getElementById("excelPreview").classList.remove("hidden");
            }
        });
        document.getElementById("pdfToExcelBtn").addEventListener("click", async function() {
            const file = document.getElementById("pdfToExcelInput").files[0];
            if (!file) return alert("Please select a PDF file");
            const progress = document.getElementById("excelProgress");
            progress.classList.remove("hidden", "text-red-500"); progress.innerHTML = "Processing...";
            const fd = new FormData(); fd.append("file", file); fd.append("action", "pdf_to_excel");
            try {
                const res = await fetch("backend/process_document.php", { method: "POST", body: fd });
                const json = await res.json();
                if (json.error) { progress.innerHTML = "Error: " + json.error; progress.classList.add("text-red-500"); }
                else {
                    const a = document.createElement("a"); a.href = json.fileData; a.download = json.fileName; a.click();
                    progress.innerHTML = "Complete!";
                }
            } catch(e) { progress.innerHTML = "Error: " + e.message; progress.classList.add("text-red-500"); }
        });
    </script>';
}

function getWordToPdfFixedHTML() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\\'wordToPdfInput\\').click()">
            <input type="file" id="wordToPdfInput" class="hidden" accept=".doc,.docx">
            <div class="text-5xl mb-3">📝➡️📄</div>
            <p class="font-medium">Select Word file to convert to PDF (Server API)</p>
        </div>
        <div id="wordPreview" class="text-sm text-gray-500 text-center hidden"></div>
        <button id="wordToPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Convert to PDF</button>
        <div id="wordProgress" class="text-sm text-gray-500 text-center hidden"></div>
    </div>
    <script>
        document.getElementById("wordToPdfInput").addEventListener("change", function() {
            if(this.files[0]) {
                document.getElementById("wordPreview").innerHTML = "Selected: " + this.files[0].name;
                document.getElementById("wordPreview").classList.remove("hidden");
            }
        });
        document.getElementById("wordToPdfBtn").addEventListener("click", async function() {
            const file = document.getElementById("wordToPdfInput").files[0];
            if (!file) return alert("Please select a Word file");
            const progress = document.getElementById("wordProgress");
            progress.classList.remove("hidden", "text-red-500"); progress.innerHTML = "Processing...";
            const fd = new FormData(); fd.append("file", file); fd.append("action", "word_to_pdf");
            try {
                const res = await fetch("backend/process_document.php", { method: "POST", body: fd });
                const json = await res.json();
                if (json.error) { progress.innerHTML = "Error: " + json.error; progress.classList.add("text-red-500"); }
                else {
                    const a = document.createElement("a"); a.href = json.fileData; a.download = json.fileName; a.click();
                    progress.innerHTML = "Complete!";
                }
            } catch(e) { progress.innerHTML = "Error: " + e.message; progress.classList.add("text-red-500"); }
        });
    </script>';
}

function getProtectPdfFixedHTML() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\\'protectPdfInput\\').click()">
            <input type="file" id="protectPdfInput" class="hidden" accept=".pdf">
            <div class="text-5xl mb-3">🔒</div>
            <p class="font-medium">Select PDF to protect (Server API)</p>
        </div>
        <div id="protectPreview" class="text-sm text-gray-500 text-center hidden"></div>
        <div class="space-y-4">
            <input type="password" id="pdfPassword" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl" placeholder="Password">
        </div>
        <button id="protectPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Protect PDF</button>
        <div id="protectProgress" class="text-sm text-gray-500 text-center hidden"></div>
    </div>
    <script>
        document.getElementById("protectPdfInput").addEventListener("change", function() {
            if(this.files[0]) {
                document.getElementById("protectPreview").innerHTML = "Selected: " + this.files[0].name;
                document.getElementById("protectPreview").classList.remove("hidden");
            }
        });
        document.getElementById("protectPdfBtn").addEventListener("click", async function() {
            const file = document.getElementById("protectPdfInput").files[0];
            const pass = document.getElementById("pdfPassword").value;
            if (!file) return alert("Select PDF file");
            if (!pass) return alert("Enter password");
            const progress = document.getElementById("protectProgress");
            progress.classList.remove("hidden", "text-red-500"); progress.innerHTML = "Processing...";
            const fd = new FormData(); fd.append("file", file); fd.append("action", "protect_pdf"); fd.append("password", pass);
            try {
                const res = await fetch("backend/process_document.php", { method: "POST", body: fd });
                const json = await res.json();
                if (json.error) { progress.innerHTML = "Error: " + json.error; progress.classList.add("text-red-500"); }
                else {
                    const a = document.createElement("a"); a.href = json.fileData; a.download = json.fileName; a.click();
                    progress.innerHTML = "Complete!";
                }
            } catch(e) { progress.innerHTML = "Error: " + e.message; progress.classList.add("text-red-500"); }
        });
    </script>';
}

function getJsonToCsvFixedHTML() {
    return '
    <div class="space-y-6">
        <textarea id="jsonInput" class="w-full h-64 p-4 bg-gray-50 rounded-xl font-mono text-sm border border-gray-200" placeholder=\'[{"name": "John"}]\'>[{"name":"Any2Convert", "features": "Great"}]</textarea>
        <button id="jsonToCsvBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Convert to CSV</button>
        <div id="csvResult" class="hidden mt-4">
            <pre id="csvPreview" class="text-xs bg-gray-100 p-4 rounded"></pre>
            <button id="downloadCsvBtn" class="mt-2 bg-green-600 text-white px-4 py-2 rounded-lg text-sm">Download</button>
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
            } catch(e) { alert("Invalid JSON: " + e.message); }
        });
        document.getElementById("downloadCsvBtn").addEventListener("click", function() {
            const blob = new Blob([curCSV], { type: "text/csv" });
            const a = document.createElement("a"); a.href = URL.createObjectURL(blob); a.download = "data.csv"; a.click();
        });
    </script>';
}

function getQrGeneratorFixedHTML() {
    return '
    <div class="space-y-6">
        <textarea id="qrText" class="w-full h-32 p-4 bg-gray-50 border border-gray-200 rounded-xl" placeholder="Enter text or URL"></textarea>
        <button id="generateQrBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold transition">Generate</button>
        <div id="qrResult" class="hidden text-center mt-4">
            <img id="qrImg" class="mx-auto" />
            <br/><a id="dlQr" class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm cursor-pointer mt-2 inline-block" download="qr.png">Download</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
    <script>
        document.getElementById("generateQrBtn").addEventListener("click", function() {
            const text = document.getElementById("qrText").value;
            if(!text) return alert("Enter text");
            QRCode.toDataURL(text, { width: 300, margin: 2, scale: 10 }, function (err, url) {
                if (err) return alert("Error");
                document.getElementById("qrImg").src = url;
                document.getElementById("dlQr").href = url;
                document.getElementById("qrResult").classList.remove("hidden");
            });
        });
    </script>';
}
"""

content = content + "\\n" + new_functions

with open('backend/tool_handlers.php', 'w', encoding='utf-8') as f:
    f.write(content)
