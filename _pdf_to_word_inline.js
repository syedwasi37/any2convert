        if (window.pdfjsLib) {
            window.pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";
        }

        var pdfToWordInput = document.getElementById("pdfToWordInput");
        var pdfPreview = document.getElementById("pdfPreview");
        var wordProgress = document.getElementById("wordProgress");

        pdfToWordInput.addEventListener("change", function() {
            if (!this.files.length) {
                pdfPreview.textContent = "";
                pdfPreview.classList.add("hidden");
                return;
            }

            pdfPreview.textContent = this.files[0].name + " selected";
            pdfPreview.classList.remove("hidden");
        });

        function normalizeText(value) {
            return String(value || "")
                .split("\r").join(" ")
                .split("\n").join(" ")
                .split("\t").join(" ")
                .split(" ")
                .filter(Boolean)
                .join(" ")
                .trim();
        }

        function escapeHtml(text) {
            var div = document.createElement("div");
            div.textContent = text;
            return div.innerHTML;
        }

        function buildPlainTextPage(items) {
            var rows = {};
            var keys;

            items.forEach(function(item) {
                var text = normalizeText(item.str);
                var y;
                if (!text) return;

                y = Math.round(item.transform[5] || 0);
                if (!rows[y]) rows[y] = [];
                rows[y].push({
                    text: text,
                    x: item.transform[4] || 0
                });
            });

            keys = Object.keys(rows).map(function(key) {
                return Number(key);
            }).sort(function(a, b) {
                return b - a;
            });

            return keys.map(function(y) {
                return rows[y]
                    .sort(function(a, b) { return a.x - b.x; })
                    .map(function(part) { return part.text; })
                    .join(" ");
            }).join("\n").trim();
        }

        function makeHtmlDoc(title, renderedPages) {
            var parts = [];
            var i;

            parts.push("<!DOCTYPE html>");
            parts.push("<html><head><meta charset=\"UTF-8\"><title>" + escapeHtml(title) + "</title>");
            parts.push("<style>@page { margin: 0.5in; } body { margin: 0; font-family: Arial, sans-serif; background: #ffffff; } img { border: 0; }</style>");
            parts.push("</head><body>");

            for (i = 0; i < renderedPages.length; i++) {
                parts.push("<div style=\"" + (i < renderedPages.length - 1 ? "page-break-after: always; " : "") + "margin: 0 0 12px 0; text-align: center;\">");
                parts.push("<img src=\"" + renderedPages[i].dataUrl + "\" style=\"max-width: 100%; width: " + renderedPages[i].widthPx + "px; height: " + renderedPages[i].heightPx + "px; display: block; margin: 0 auto;\" />");
                parts.push("</div>");
            }

            parts.push("</body></html>");
            return parts.join("");
        }

        function toRtf(text) {
            return String(text || "")
                .split("\\").join("\\\\")
                .split("{").join("\\{")
                .split("}").join("\\}")
                .split("\r\n\r\n").join("\\par\\par ")
                .split("\n\n").join("\\par\\par ")
                .split("\r\n").join("\\line ")
                .split("\n").join("\\line ");
        }

        function fitWithinBox(width, height, maxWidth, maxHeight) {
            var ratio = Math.min(maxWidth / width, maxHeight / height);
            return {
                width: Math.max(1, Math.round(width * ratio)),
                height: Math.max(1, Math.round(height * ratio))
            };
        }

        document.getElementById("pdfToWordBtn").addEventListener("click", async function() {
            var input = pdfToWordInput;
            var progress = wordProgress;
            var file;
            var arrayBuffer;
            var pdf;
            var format;
            var textPages = [];
            var renderedPages = [];
            var i;
            var baseName;
            var plainText;
            var url;
            var a;

            if (!input.files.length) return alert("Please select a PDF file");
            progress.classList.remove("hidden", "text-red-500");
            
            try {
                if (!window.pdfjsLib) {
                    throw new Error("PDF library failed to load.");
                }

                window.pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";
                file = input.files[0];
                arrayBuffer = await file.arrayBuffer();
                pdf = await window.pdfjsLib.getDocument({ data: arrayBuffer }).promise;
                format = document.getElementById("wordFormat").value;

                for (i = 1; i <= pdf.numPages; i++) {
                    var page = await pdf.getPage(i);
                    var textContent;

                    progress.innerHTML = "Processing page " + i + " of " + pdf.numPages + "...";
                    textContent = await page.getTextContent({ normalizeWhitespace: true });
                    textPages.push(buildPlainTextPage(textContent.items));

                    if (format === "docx") {
                        var viewport = page.getViewport({ scale: 2 });
                        var canvas = document.createElement("canvas");
                        var context = canvas.getContext("2d", { alpha: false });
                        var fitted;

                        canvas.width = Math.ceil(viewport.width);
                        canvas.height = Math.ceil(viewport.height);
                        context.fillStyle = "#FFFFFF";
                        context.fillRect(0, 0, canvas.width, canvas.height);

                        await page.render({
                            canvasContext: context,
                            viewport: viewport
                        }).promise;

                        fitted = fitWithinBox(canvas.width, canvas.height, 720, 980);
                        renderedPages.push({
                            dataUrl: canvas.toDataURL("image/png"),
                            widthPx: fitted.width,
                            heightPx: fitted.height
                        });
                    }
                }

                baseName = file.name || "converted.pdf";
                if (baseName.toLowerCase().slice(-4) === ".pdf") {
                    baseName = baseName.slice(0, -4);
                }
                if (!baseName) {
                    baseName = "converted";
                }
                plainText = textPages.filter(Boolean).join("\n\n");

                if (format === "docx") {
                    var htmlDoc = makeHtmlDoc(baseName, renderedPages);
                    var wordBlob = new Blob([htmlDoc], { type: "application/msword" });

                    progress.innerHTML = "Preparing Word layout copy...";
                    url = URL.createObjectURL(wordBlob);
                    a = document.createElement("a");
                    a.href = url;
                    a.download = baseName + ".doc";
                    a.click();
                    URL.revokeObjectURL(url);
                } else if (format === "rtf") {
                    var rtfHeader = "{\\rtf1\\ansi\\deff0 {\\fonttbl {\\f0 Times New Roman;}}\\f0\\fs24 ";
                    var rtfContent = toRtf(plainText);
                    var rtfFooter = "}";
                    var rtfBlob = new Blob([rtfHeader + rtfContent + rtfFooter], { type: "application/rtf" });

                    url = URL.createObjectURL(rtfBlob);
                    a = document.createElement("a");
                    a.href = url;
                    a.download = baseName + ".rtf";
                    a.click();
                    URL.revokeObjectURL(url);
                } else {
                    var textBlob = new Blob([plainText], { type: "text/plain" });

                    url = URL.createObjectURL(textBlob);
                    a = document.createElement("a");
                    a.href = url;
                    a.download = baseName + ".txt";
                    a.click();
