import re

file_path = "c:/xampp/htdocs/greatPDF/backend/tool_handlers.php"
with open(file_path, "r", encoding="utf-8") as f:
    content = f.read()

# Route to Pure JS versions
content = re.sub(r"case 'protect_pdf':\n\s*echo getProtectPdfHTML\(\);", "case 'protect_pdf':\n        echo getProtectPdfPureJS();", content)
content = re.sub(r"case 'qr_generator':\n\s*echo getQrGeneratorHTML\(\);", "case 'qr_generator':\n        echo getQrGeneratorPureJS();", content)

# Fix input dark/light mode issues.
# Replace bg-gray-50 dark:bg-gray-700 with bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100
content = re.sub(r"bg-gray-50 dark:bg-gray-700", "bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100", content)
content = re.sub(r"bg-gray-50 border", "bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 border", content) # for getProtectPdfPureJS

with open(file_path, "w", encoding="utf-8") as f:
    f.write(content)
print("Done")
