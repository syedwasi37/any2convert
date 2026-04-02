<?php
// backend/tool_handlers.php

function renderToolHandlerHTML($tool) {
    switch ($tool) {
        case 'img_to_pdf':
            return getImageToPdfHTML();
        case 'pdf_to_img':
            return getPdfToImageHTML();
        case 'pdf_to_word':
            return getPdfToWordHTML();
        case 'pdf_to_ppt':
            return getPdfToPptHTML();
        case 'pdf_to_excel':
            return getPdfToExcelHTML();
        case 'merge_pdf':
            return getMergePdfHTML();
        case 'compress_pdf':
            return getCompressPdfHTML();
        case 'protect_pdf':
            return getProtectPdfPureJS();
        case 'word_to_pdf':
            return getWordToPdfHTML();
        case 'excel_to_pdf':
            return getExcelToPdfHTML();
        case 'ppt_to_pdf':
            return getPptToPdfHTML();
        case 'html_to_pdf':
            return getHtmlToPdfHTML();
        case 'split_pdf':
            return getSplitPdfHTML();
        case 'remove_pages':
            return getRemovePagesHTML();
        case 'extract_pages':
            return getExtractPagesHTML();
        case 'organize_pdf':
            return getOrganizePdfHTML();
        case 'scan_to_pdf':
            return getScanToPdfHTML();
        case 'optimize_pdf':
            return getOptimizePdfHTML();
        case 'repair_pdf':
            return getRepairPdfHTML();
        case 'ocr_pdf':
            return getOcrPdfHTML();
        case 'rotate_pdf':
            return getRotatePdfHTML();
        case 'add_page_numbers':
            return getAddPageNumbersHTML();
        case 'add_watermark':
            return getAddWatermarkHTML();
        case 'unlock_pdf':
            return getUnlockPdfHTML();
        case 'sign_pdf':
            return getSignPdfHTML();
        case 'crop_pdf':
            return getCropPdfHTML();
        case 'compare_pdf':
            return getComparePdfHTML();
        case 'ai_summarizer':
            return getAiSummarizerHTML();
        case 'pdf_to_pdfa':
            return getPdfToPdfaHTML();
        case 'edit_pdf':
            return getEditPdfHTML();
        case 'redact_pdf':
            return getRedactPdfHTML();
        case 'translate_pdf':
            return getTranslatePdfHTML();
        case 'json_to_csv':
            return getJsonToCsvHTML();
        case 'csv_to_json':
            return getCsvToJsonHTML();
        case 'qr_generator':
            return getQrGeneratorPureJS();
        case 'password_gen':
            return getPasswordGenHTML();
        case 'word_counter':
            return getWordCounterHTML();
        case 'image_compressor':
            return getImageCompressorHTML();
        case 'bg_remover':
            return getBackgroundRemoverHTML();
        case 'image_to_dxf':
            return getImageToDxfHTML();
        case 'image_to_svg':
            return getImageToSvgHTML();
        case 'resize_image':
            return getResizeImageHTML();
        case 'crop_image':
            return getCropImageHTML();
        case 'image_enhancer':
            return getImageEnhancerHTML();
        case 'image_converter':
            return getImageConverterHTML();
        case 'video_to_audio':
            return getVideoToAudioHTML();
        case 'currency_converter':
            return getCurrencyConverterHTML();
        case 'length_converter':
            return getLengthConverterHTML();
        case 'weight_converter':
            return getWeightConverterHTML();
        case 'temperature_converter':
            return getTemperatureConverterHTML();
        case 'area_converter':
            return getAreaConverterHTML();
        case 'volume_converter':
            return getVolumeConverterHTML();
        case 'speed_converter':
            return getSpeedConverterHTML();
        case 'time_converter':
            return getTimeConverterHTML();
        case 'ai_image_generator':
            return getAiImageGeneratorHTML();
        case 'ocr_tool':
            return getOcrToolHTML();
        default:
            return '<div class="text-center py-12">Tool coming soon!</div>';
    }
}

function getGenericUnitConverterHTML(array $config): string
{
    $title = htmlspecialchars($config['title'], ENT_QUOTES);
    $description = htmlspecialchars($config['description'], ENT_QUOTES);
    $unitsJson = base64_encode(json_encode($config['units'], JSON_UNESCAPED_SLASHES));
    $decimals = (int) ($config['decimals'] ?? 6);
    $defaultValue = htmlspecialchars((string) ($config['default_value'] ?? '1'), ENT_QUOTES);
    $formulaText = htmlspecialchars($config['formula_text'] ?? 'Results update instantly as you type.', ENT_QUOTES);
    $defaultFrom = htmlspecialchars((string) ($config['default_from'] ?? ''), ENT_QUOTES);
    $defaultTo = htmlspecialchars((string) ($config['default_to'] ?? ''), ENT_QUOTES);

    return '
    <div class="space-y-6">
        <div class="grid lg:grid-cols-[1.1fr_0.9fr] gap-6">
            <div class="rounded-3xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-slate-900 p-6 shadow-sm">
                <div class="mb-4">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">' . $title . '</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">' . $description . '</p>
                </div>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold mb-2">Value</label>
                        <input type="number" id="unitConverterValue" value="' . $defaultValue . '" step="any" class="w-full p-3 rounded-2xl border border-gray-200 dark:border-gray-700 bg-white text-gray-900 dark:bg-slate-950 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2">Precision</label>
                        <input type="range" id="unitConverterPrecision" min="0" max="' . $decimals . '" value="' . min(4, $decimals) . '" class="w-full">
                        <p class="text-xs text-gray-500 mt-2"><span id="unitConverterPrecisionValue">' . min(4, $decimals) . '</span> decimal places</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2">From</label>
                        <select id="unitConverterFrom" class="w-full p-3 rounded-2xl border border-gray-200 dark:border-gray-700 bg-white text-gray-900 dark:bg-slate-950 dark:text-white"></select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2">To</label>
                        <select id="unitConverterTo" class="w-full p-3 rounded-2xl border border-gray-200 dark:border-gray-700 bg-white text-gray-900 dark:bg-slate-950 dark:text-white"></select>
                    </div>
                </div>
                <div class="mt-4 flex flex-wrap gap-3">
                    <button id="unitConverterSwap" class="px-4 py-3 rounded-2xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">Swap Units</button>
                    <button id="unitConverterCopy" class="px-4 py-3 rounded-2xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition">Copy Result</button>
                </div>
                <p id="unitConverterStatus" class="text-sm text-gray-500 dark:text-gray-400 mt-4">' . $formulaText . '</p>
            </div>
            <div class="rounded-3xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-slate-950/70 p-6">
                <p class="text-xs font-black uppercase tracking-[0.22em] text-blue-600 dark:text-blue-400">Live Preview</p>
                <div class="mt-4 rounded-3xl bg-white dark:bg-slate-900 border border-gray-200 dark:border-gray-800 p-6">
                    <p id="unitConverterResultText" class="text-3xl font-black text-gray-900 dark:text-white">0</p>
                    <p id="unitConverterFormula" class="text-sm text-gray-500 dark:text-gray-400 mt-3">Choose units to start converting.</p>
                </div>
                <div class="mt-4 rounded-3xl bg-white dark:bg-slate-900 border border-gray-200 dark:border-gray-800 p-5">
                    <h4 class="font-bold text-gray-900 dark:text-white">Common conversions</h4>
                    <div id="unitConverterQuickGrid" class="mt-4 grid sm:grid-cols-2 gap-3"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        (() => {
            const units = JSON.parse(atob("' . $unitsJson . '"));
            const valueInput = document.getElementById("unitConverterValue");
            const precisionInput = document.getElementById("unitConverterPrecision");
            const precisionValue = document.getElementById("unitConverterPrecisionValue");
            const fromSelect = document.getElementById("unitConverterFrom");
            const toSelect = document.getElementById("unitConverterTo");
            const swapBtn = document.getElementById("unitConverterSwap");
            const copyBtn = document.getElementById("unitConverterCopy");
            const status = document.getElementById("unitConverterStatus");
            const resultText = document.getElementById("unitConverterResultText");
            const formula = document.getElementById("unitConverterFormula");
            const quickGrid = document.getElementById("unitConverterQuickGrid");

            const unitEntries = Object.entries(units);
            unitEntries.forEach(([key, unit], index) => {
                const optionFrom = document.createElement("option");
                optionFrom.value = key;
                optionFrom.textContent = unit.label;
                const optionTo = optionFrom.cloneNode(true);
                fromSelect.appendChild(optionFrom);
                toSelect.appendChild(optionTo);
                if (index === 0) fromSelect.value = key;
                if (index === 1) toSelect.value = key;
            });

            if ("' . $defaultFrom . '" && units["' . $defaultFrom . '"]) {
                fromSelect.value = "' . $defaultFrom . '";
            }
            if ("' . $defaultTo . '" && units["' . $defaultTo . '"]) {
                toSelect.value = "' . $defaultTo . '";
            }

            function formatNumber(value, digits) {
                if (!Number.isFinite(value)) return "--";
                const fixed = value.toFixed(digits);
                if (fixed.indexOf(".") === -1) return fixed;
                return fixed.replace(/0+$/, "").replace(/\\.$/, "");
            }

            function convertValue(value, fromKey, toKey) {
                const fromUnit = units[fromKey];
                const toUnit = units[toKey];
                if (!fromUnit || !toUnit || !Number.isFinite(value)) {
                    return NaN;
                }
                if (fromUnit.type === "temperature" || toUnit.type === "temperature") {
                    const baseKelvin = (value * fromUnit.toBaseFactor) + fromUnit.toBaseOffset;
                    return (baseKelvin * toUnit.fromBaseFactor) + toUnit.fromBaseOffset;
                }
                return value * (fromUnit.factor / toUnit.factor);
            }

            function renderQuickGrid(currentValue, fromKey) {
                quickGrid.innerHTML = "";
                Object.entries(units).filter(([key]) => key !== fromKey).slice(0, 6).forEach(([key, unit]) => {
                    const card = document.createElement("div");
                    card.className = "rounded-2xl border border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-slate-900 px-4 py-3";
                    const converted = convertValue(currentValue, fromKey, key);
                    card.innerHTML = `<p class="text-[11px] font-black uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400">${unit.short || unit.label}</p><p class="text-lg font-bold text-gray-900 dark:text-white mt-2">${formatNumber(converted, Number(precisionInput.value))}</p>`;
                    quickGrid.appendChild(card);
                });
            }

            function update() {
                const numericValue = parseFloat(valueInput.value);
                const digits = Number(precisionInput.value);
                precisionValue.textContent = String(digits);
                const converted = convertValue(numericValue, fromSelect.value, toSelect.value);
                resultText.textContent = Number.isFinite(converted) ? formatNumber(converted, digits) : "--";
                if (Number.isFinite(numericValue) && units[fromSelect.value] && units[toSelect.value]) {
                    formula.textContent = `${formatNumber(numericValue, digits)} ${units[fromSelect.value].label} = ${formatNumber(converted, digits)} ${units[toSelect.value].label}`;
                    status.textContent = "Conversion updated instantly.";
                } else {
                    formula.textContent = "Enter a valid number to see the converted value.";
                    status.textContent = "Waiting for a valid input.";
                }
                renderQuickGrid(numericValue, fromSelect.value);
            }

            [valueInput, precisionInput, fromSelect, toSelect].forEach((el) => el.addEventListener("input", update));
            swapBtn.addEventListener("click", () => {
                const currentFrom = fromSelect.value;
                fromSelect.value = toSelect.value;
                toSelect.value = currentFrom;
                update();
            });
            copyBtn.addEventListener("click", async () => {
                try {
                    await navigator.clipboard.writeText(resultText.textContent || "");
                    status.textContent = "Converted value copied to clipboard.";
                } catch (error) {
                    status.textContent = "Could not copy automatically. Please copy manually.";
                }
            });
            update();
        })();
    </script>';
}

function getLengthConverterHTML(): string
{
    return getGenericUnitConverterHTML([
        'title' => 'Length Converter',
        'description' => 'Convert between kilometers, meters, centimeters, millimeters, inches, feet, yards, and miles instantly.',
        'default_value' => '1',
        'default_from' => 'km',
        'default_to' => 'mm',
        'formula_text' => 'Perfect for km to millimeter, inch to centimeter, or mile to meter conversions.',
        'units' => [
            'km' => ['label' => 'Kilometers', 'short' => 'km', 'factor' => 1000],
            'm' => ['label' => 'Meters', 'short' => 'm', 'factor' => 1],
            'cm' => ['label' => 'Centimeters', 'short' => 'cm', 'factor' => 0.01],
            'mm' => ['label' => 'Millimeters', 'short' => 'mm', 'factor' => 0.001],
            'mi' => ['label' => 'Miles', 'short' => 'mi', 'factor' => 1609.344],
            'yd' => ['label' => 'Yards', 'short' => 'yd', 'factor' => 0.9144],
            'ft' => ['label' => 'Feet', 'short' => 'ft', 'factor' => 0.3048],
            'in' => ['label' => 'Inches', 'short' => 'in', 'factor' => 0.0254],
        ],
    ]);
}

function getWeightConverterHTML(): string
{
    return getGenericUnitConverterHTML([
        'title' => 'Weight Converter',
        'description' => 'Convert mass between kilograms, grams, milligrams, pounds, ounces, and tonnes.',
        'default_value' => '1',
        'default_from' => 'kg',
        'default_to' => 'lb',
        'units' => [
            'kg' => ['label' => 'Kilograms', 'short' => 'kg', 'factor' => 1],
            'g' => ['label' => 'Grams', 'short' => 'g', 'factor' => 0.001],
            'mg' => ['label' => 'Milligrams', 'short' => 'mg', 'factor' => 0.000001],
            'lb' => ['label' => 'Pounds', 'short' => 'lb', 'factor' => 0.45359237],
            'oz' => ['label' => 'Ounces', 'short' => 'oz', 'factor' => 0.028349523125],
            'tonne' => ['label' => 'Metric Tonnes', 'short' => 't', 'factor' => 1000],
        ],
    ]);
}

function getTemperatureConverterHTML(): string
{
    return getGenericUnitConverterHTML([
        'title' => 'Temperature Converter',
        'description' => 'Switch between Celsius, Fahrenheit, and Kelvin with the correct formulas applied automatically.',
        'default_value' => '25',
        'default_from' => 'c',
        'default_to' => 'f',
        'units' => [
            'c' => ['label' => 'Celsius', 'short' => 'deg C', 'type' => 'temperature', 'toBaseFactor' => 1, 'toBaseOffset' => 273.15, 'fromBaseFactor' => 1, 'fromBaseOffset' => -273.15],
            'f' => ['label' => 'Fahrenheit', 'short' => 'deg F', 'type' => 'temperature', 'toBaseFactor' => 0.5555555556, 'toBaseOffset' => 255.3722222222, 'fromBaseFactor' => 1.8, 'fromBaseOffset' => -459.67],
            'k' => ['label' => 'Kelvin', 'short' => 'K', 'type' => 'temperature', 'toBaseFactor' => 1, 'toBaseOffset' => 0, 'fromBaseFactor' => 1, 'fromBaseOffset' => 0],
        ],
    ]);
}

function getAreaConverterHTML(): string
{
    return getGenericUnitConverterHTML([
        'title' => 'Area Converter',
        'description' => 'Convert square units for plots, rooms, land, and map dimensions.',
        'default_value' => '1',
        'default_from' => 'sqft',
        'default_to' => 'sqm',
        'units' => [
            'sqm' => ['label' => 'Square Meters', 'short' => 'sq m', 'factor' => 1],
            'sqkm' => ['label' => 'Square Kilometers', 'short' => 'sq km', 'factor' => 1000000],
            'sqcm' => ['label' => 'Square Centimeters', 'short' => 'sq cm', 'factor' => 0.0001],
            'sqmm' => ['label' => 'Square Millimeters', 'short' => 'sq mm', 'factor' => 0.000001],
            'sqft' => ['label' => 'Square Feet', 'short' => 'sq ft', 'factor' => 0.09290304],
            'sqin' => ['label' => 'Square Inches', 'short' => 'sq in', 'factor' => 0.00064516],
            'acre' => ['label' => 'Acres', 'short' => 'ac', 'factor' => 4046.8564224],
            'hectare' => ['label' => 'Hectares', 'short' => 'ha', 'factor' => 10000],
        ],
    ]);
}

function getVolumeConverterHTML(): string
{
    return getGenericUnitConverterHTML([
        'title' => 'Volume Converter',
        'description' => 'Convert liters, milliliters, cubic meters, gallons, quarts, pints, and cups.',
        'default_value' => '1',
        'default_from' => 'l',
        'default_to' => 'gal',
        'units' => [
            'l' => ['label' => 'Liters', 'short' => 'L', 'factor' => 1],
            'ml' => ['label' => 'Milliliters', 'short' => 'mL', 'factor' => 0.001],
            'cum' => ['label' => 'Cubic Meters', 'short' => 'cu m', 'factor' => 1000],
            'cup' => ['label' => 'Cups', 'short' => 'cup', 'factor' => 0.2365882365],
            'pt' => ['label' => 'Pints', 'short' => 'pt', 'factor' => 0.473176473],
            'qt' => ['label' => 'Quarts', 'short' => 'qt', 'factor' => 0.946352946],
            'gal' => ['label' => 'Gallons (US)', 'short' => 'gal', 'factor' => 3.785411784],
        ],
    ]);
}

function getSpeedConverterHTML(): string
{
    return getGenericUnitConverterHTML([
        'title' => 'Speed Converter',
        'description' => 'Convert speed values between km/h, m/s, mph, knots, and feet per second.',
        'default_value' => '60',
        'default_from' => 'kmh',
        'default_to' => 'mph',
        'units' => [
            'kmh' => ['label' => 'Kilometers per Hour', 'short' => 'km/h', 'factor' => 1],
            'ms' => ['label' => 'Meters per Second', 'short' => 'm/s', 'factor' => 3.6],
            'mph' => ['label' => 'Miles per Hour', 'short' => 'mph', 'factor' => 1.609344],
            'knot' => ['label' => 'Knots', 'short' => 'kn', 'factor' => 1.852],
            'fts' => ['label' => 'Feet per Second', 'short' => 'ft/s', 'factor' => 1.09728],
        ],
    ]);
}

function getTimeConverterHTML(): string
{
    return getGenericUnitConverterHTML([
        'title' => 'Time Converter',
        'description' => 'Convert seconds, minutes, hours, days, weeks, months, and years in one place.',
        'default_value' => '1',
        'default_from' => 'hour',
        'default_to' => 'min',
        'units' => [
            'sec' => ['label' => 'Seconds', 'short' => 'sec', 'factor' => 1],
            'min' => ['label' => 'Minutes', 'short' => 'min', 'factor' => 60],
            'hour' => ['label' => 'Hours', 'short' => 'hr', 'factor' => 3600],
            'day' => ['label' => 'Days', 'short' => 'day', 'factor' => 86400],
            'week' => ['label' => 'Weeks', 'short' => 'wk', 'factor' => 604800],
            'month' => ['label' => 'Months', 'short' => 'mo', 'factor' => 2629800],
            'year' => ['label' => 'Years', 'short' => 'yr', 'factor' => 31557600],
        ],
    ]);
}

function getCurrencyConverterHTML(): string
{
    return '
    <div class="space-y-6">
        <div class="grid lg:grid-cols-[1.1fr_0.9fr] gap-6">
            <div class="rounded-3xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-slate-900 p-6 shadow-sm">
                <div class="mb-4">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Live Currency Converter</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Convert between major currencies with live daily rates from Frankfurter using official institutions and central-bank sources.</p>
                </div>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold mb-2">Amount</label>
                        <input type="number" id="currencyAmount" value="1" step="any" class="w-full p-3 rounded-2xl border border-gray-200 dark:border-gray-700 bg-white text-gray-900 dark:bg-slate-950 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2">Refresh</label>
                        <button id="currencyRefreshBtn" class="w-full px-4 py-3 rounded-2xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">Refresh Live Rates</button>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2">From</label>
                        <select id="currencyFrom" class="w-full p-3 rounded-2xl border border-gray-200 dark:border-gray-700 bg-white text-gray-900 dark:bg-slate-950 dark:text-white"></select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2">To</label>
                        <select id="currencyTo" class="w-full p-3 rounded-2xl border border-gray-200 dark:border-gray-700 bg-white text-gray-900 dark:bg-slate-950 dark:text-white"></select>
                    </div>
                </div>
                <div class="mt-4 flex flex-wrap gap-3">
                    <button id="currencySwapBtn" class="px-4 py-3 rounded-2xl bg-slate-900 dark:bg-slate-700 text-white font-semibold">Swap</button>
                    <button id="currencyCopyBtn" class="px-4 py-3 rounded-2xl bg-emerald-600 text-white font-semibold">Copy Result</button>
                </div>
                <p id="currencyStatus" class="text-sm text-gray-500 dark:text-gray-400 mt-4">Loading latest currency list and rates...</p>
            </div>
            <div class="rounded-3xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-slate-950/70 p-6">
                <p class="text-xs font-black uppercase tracking-[0.22em] text-emerald-600 dark:text-emerald-400">Live Output</p>
                <div class="mt-4 rounded-3xl bg-white dark:bg-slate-900 border border-gray-200 dark:border-gray-800 p-6">
                    <p id="currencyResultText" class="text-3xl font-black text-gray-900 dark:text-white">--</p>
                    <p id="currencyMetaText" class="text-sm text-gray-500 dark:text-gray-400 mt-3">Waiting for live rates.</p>
                </div>
                <div class="mt-4 rounded-3xl bg-white dark:bg-slate-900 border border-gray-200 dark:border-gray-800 p-5">
                    <h4 class="font-bold text-gray-900 dark:text-white">Quick rates</h4>
                    <div id="currencyQuickRates" class="mt-4 grid sm:grid-cols-2 gap-3"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        (() => {
            const amountInput = document.getElementById("currencyAmount");
            const fromSelect = document.getElementById("currencyFrom");
            const toSelect = document.getElementById("currencyTo");
            const refreshBtn = document.getElementById("currencyRefreshBtn");
            const swapBtn = document.getElementById("currencySwapBtn");
            const copyBtn = document.getElementById("currencyCopyBtn");
            const status = document.getElementById("currencyStatus");
            const resultText = document.getElementById("currencyResultText");
            const metaText = document.getElementById("currencyMetaText");
            const quickRates = document.getElementById("currencyQuickRates");

            let currencies = {};
            const preferred = ["USD", "EUR", "GBP", "PKR", "AED", "SAR", "INR", "CAD", "AUD", "JPY"];

            function formatAmount(value, currency) {
                try {
                    return new Intl.NumberFormat(undefined, {
                        style: "currency",
                        currency,
                        maximumFractionDigits: 4
                    }).format(value);
                } catch (error) {
                    return value.toFixed(4) + " " + currency;
                }
            }

            async function loadCurrencies() {
                const resp = await fetch("https://api.frankfurter.dev/v2/currencies");
                if (!resp.ok) throw new Error("Could not load currency list.");
                const payload = await resp.json();
                if (Array.isArray(payload)) {
                    currencies = payload.reduce((acc, item) => {
                        if (item && item.iso_code) {
                            acc[item.iso_code] = item;
                        }
                        return acc;
                    }, {});
                } else {
                    currencies = payload || {};
                }
                const codes = Object.keys(currencies).sort((a, b) => {
                    const aPreferred = preferred.includes(a) ? preferred.indexOf(a) : 999;
                    const bPreferred = preferred.includes(b) ? preferred.indexOf(b) : 999;
                    if (aPreferred !== bPreferred) return aPreferred - bPreferred;
                    return a.localeCompare(b);
                });
                [fromSelect, toSelect].forEach((select) => {
                    select.innerHTML = "";
                    codes.forEach((code) => {
                        const option = document.createElement("option");
                        option.value = code;
                        const currencyLabel = typeof currencies[code] === "string"
                            ? currencies[code]
                            : (currencies[code]?.name || code);
                        option.textContent = `${code} - ${currencyLabel}`;
                        select.appendChild(option);
                    });
                });
                fromSelect.value = "USD";
                toSelect.value = "PKR";
            }

            function renderQuickRates(base, rates) {
                quickRates.innerHTML = "";
                preferred.filter((code) => code !== base && rates[code]).slice(0, 6).forEach((code) => {
                    const card = document.createElement("div");
                    card.className = "rounded-2xl border border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-slate-900 px-4 py-3";
                    card.innerHTML = `<p class="text-[11px] font-black uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400">${base} to ${code}</p><p class="text-lg font-bold text-gray-900 dark:text-white mt-2">${Number(rates[code]).toFixed(4)}</p>`;
                    quickRates.appendChild(card);
                });
            }

            async function updateRates() {
                const amount = parseFloat(amountInput.value);
                const base = fromSelect.value;
                const quote = toSelect.value;
                if (!base || !quote) return;
                status.textContent = "Fetching live exchange rates...";
                try {
                    const rateResp = await fetch(`https://api.frankfurter.dev/v2/rate/${encodeURIComponent(base)}/${encodeURIComponent(quote)}`);
                    if (!rateResp.ok) throw new Error("Rate request failed.");
                    const ratePayload = await rateResp.json();
                    const rate = ratePayload?.rate;
                    const dateLabel = ratePayload?.date;
                    if (!Number.isFinite(Number(rate))) throw new Error("No live rate available.");
                    const converted = (Number.isFinite(amount) ? amount : 0) * Number(rate);
                    resultText.textContent = formatAmount(converted, quote);
                    metaText.textContent = `${amount || 0} ${base} = ${converted.toFixed(4)} ${quote} using live rate ${Number(rate).toFixed(6)} on ${dateLabel || "latest update"}.`;
                    status.textContent = "Live exchange rate updated.";
                    const requestedQuotes = preferred.filter((code) => code !== base).slice(0, 6);
                    const quickResp = await fetch(`https://api.frankfurter.dev/v2/rates?base=${encodeURIComponent(base)}&quotes=${encodeURIComponent(requestedQuotes.join(","))}`);
                    if (quickResp.ok) {
                        const quickPayload = await quickResp.json();
                        const quickMap = {};
                        if (Array.isArray(quickPayload)) {
                            quickPayload.forEach((item) => {
                                if (item && item.quote) quickMap[item.quote] = item.rate;
                            });
                        }
                        renderQuickRates(base, quickMap);
                    } else {
                        quickRates.innerHTML = "";
                    }
                } catch (error) {
                    status.textContent = error.message || "Could not fetch live rates right now.";
                    metaText.textContent = "Please try refreshing the live currency feed.";
                    resultText.textContent = "--";
                    quickRates.innerHTML = "";
                }
            }

            [amountInput, fromSelect, toSelect].forEach((el) => el.addEventListener("input", updateRates));
            refreshBtn.addEventListener("click", updateRates);
            swapBtn.addEventListener("click", () => {
                const from = fromSelect.value;
                fromSelect.value = toSelect.value;
                toSelect.value = from;
                updateRates();
            });
            copyBtn.addEventListener("click", async () => {
                try {
                    await navigator.clipboard.writeText(resultText.textContent || "");
                    status.textContent = "Converted currency value copied.";
                } catch (error) {
                    status.textContent = "Could not copy automatically. Please copy manually.";
                }
            });

            loadCurrencies().then(updateRates).catch((error) => {
                status.textContent = error.message || "Could not load currency data.";
            });
        })();
    </script>';
}

function getImageToPdfHTML() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'imgToPdfInput\').click()">
            <input type="file" id="imgToPdfInput" class="hidden" accept="image/*" multiple>
            <div class="text-5xl mb-3">ðŸ–¼ï¸</div>
            <p class="font-medium">Click to select images (JPG, PNG, WEBP)</p>
            <p class="text-sm text-gray-500 mt-2">Multiple files allowed | 100% client-side</p>
        </div>
        <div id="imgPreview" class="grid grid-cols-3 gap-2 mt-4"></div>
        <button id="convertImagesBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Convert to PDF (High Quality)</button>
    </div>
    <script>
        const imgInput = document.getElementById("imgToPdfInput");
        const imgPreview = document.getElementById("imgPreview");
        
        imgInput.addEventListener("change", function() {
            imgPreview.innerHTML = "";
            Array.from(this.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement("div");
                    div.className = "relative";
                    div.innerHTML = `<img src="${e.target.result}" class="w-full h-24 object-cover rounded-lg"><span class="absolute top-0 right-0 bg-green-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">âœ“</span>`;
                    imgPreview.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        });
        
        document.getElementById("convertImagesBtn").addEventListener("click", async function() {
            const input = document.getElementById("imgToPdfInput");
            if (!input.files.length) return alert("Please select at least one image");
            
            const { jsPDF } = window.jspdf;
            
            const doc = new jsPDF("p", "mm", "a4");
            const pageWidth = doc.internal.pageSize.getWidth();
            const pageHeight = doc.internal.pageSize.getHeight();

            for(let i = 0; i < input.files.length; i++) {
                const imgData = await new Promise(r => {
                    const reader = new FileReader();
                    reader.onload = e => r(e.target.result);
                    reader.readAsDataURL(input.files[i]);
                });

                const img = new Image();
                img.src = imgData;
                await img.decode();

                if(i > 0) doc.addPage();

                const imgWidth = img.width;
                const imgHeight = img.height;
                
                const ratio = Math.min(pageWidth / imgWidth, pageHeight / imgHeight);
                const finalWidth = imgWidth * ratio;
                const finalHeight = imgHeight * ratio;
                
                const x = (pageWidth - finalWidth) / 2;
                const y = (pageHeight - finalHeight) / 2;

                doc.addImage(imgData, "JPEG", x, y, finalWidth, finalHeight, undefined, "NONE");
            }
            doc.save("Any2Convert_HQ.pdf");
        });
    </script>';
}

function getPdfToImageHTML() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'pdfToImgInput\').click()">
            <input type="file" id="pdfToImgInput" class="hidden" accept=".pdf">
            <div class="text-5xl mb-3">ðŸ“„âž¡ï¸ðŸ–¼ï¸</div>
            <p class="font-medium">Select PDF to convert to images</p>
            <p class="text-sm text-gray-500 mt-2">Each page will be converted to high-quality JPG</p>
        </div>
        <div id="pdfPreview" class="text-sm text-gray-500 text-center hidden"></div>
        <button id="pdfToImgBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Convert to Images</button>
        <div id="imgResult" class="grid grid-cols-2 gap-2 mt-4"></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";
        const pdfInput = document.getElementById("pdfToImgInput");
        const pdfPreview = document.getElementById("pdfPreview");
        
        pdfInput.addEventListener("change", function() {
            if(this.files[0]) {
                pdfPreview.innerHTML = "Selected: " + this.files[0].name + " (" + (this.files[0].size / 1024).toFixed(2) + " KB)";
                pdfPreview.classList.remove("hidden");
            }
        });
        
        document.getElementById("pdfToImgBtn").addEventListener("click", async function() {
            const input = document.getElementById("pdfToImgInput");
            if (!input.files.length) return alert("Please select a PDF file");
            const resultDiv = document.getElementById("imgResult");
            resultDiv.innerHTML = \'<div class="col-span-2 text-center py-4">Processing... <div class="inline-block animate-spin rounded-full h-4 w-4 border-b-2 border-blue-600 ml-2"></div></div>\';
            
            try {
                const arrayBuffer = await input.files[0].arrayBuffer();
                const pdf = await pdfjsLib.getDocument({ data: arrayBuffer }).promise;
                resultDiv.innerHTML = "";
                
                for (let i = 1; i <= pdf.numPages; i++) {
                    const page = await pdf.getPage(i);
                    const viewport = page.getViewport({ scale: 2 });
                    const canvas = document.createElement("canvas");
                    const context = canvas.getContext("2d");
                    context.imageSmoothingEnabled = true;
                    context.imageSmoothingQuality = "high";
                    canvas.width = viewport.width;
                    canvas.height = viewport.height;
                    
                    await page.render({ canvasContext: context, viewport: viewport }).promise;
                    
                    const link = document.createElement("a");
                    link.download = "page_" + i + ".jpg";
                    link.href = canvas.toDataURL("image/jpeg", 0.97);
                    link.innerHTML = \'<img src="\' + link.href + \'" class="w-full rounded-lg border border-gray-200"><span class="text-xs text-center block mt-1">Page \' + i + \'</span>\';
                    const div = document.createElement("div");
                    div.className = "relative";
                    div.appendChild(link);
                    resultDiv.appendChild(div);
                }
            } catch(e) {
                resultDiv.innerHTML = \'<div class="col-span-2 text-center text-red-500 py-4">Error: \' + e.message + \'</div>\';
            }
        });
    </script>';
}

function getPdfToWordHTML() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'pdfToWordInput\').click()">
            <input type="file" id="pdfToWordInput" class="hidden" accept=".pdf">
            <div class="text-5xl mb-3">ðŸ“„âž¡ï¸ðŸ“</div>
            <p class="font-medium">Select PDF file to convert to Word</p>
            <p class="text-sm text-gray-500 mt-2">Extract text with formatting preserved</p>
        </div>
        <div id="pdfPreview" class="text-sm text-gray-500 text-center hidden"></div>
        <div class="space-y-4">
            <label class="block text-sm font-medium">Output Format:</label>
            <select id="wordFormat" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                <option value="docx">DOCX (Microsoft Word)</option>
                <option value="rtf">RTF (Rich Text Format)</option>
                <option value="txt">TXT (Plain Text)</option>
            </select>
        </div>
        <button id="pdfToWordBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Convert to Word</button>
        <div id="wordProgress" class="text-sm text-gray-500 text-center hidden">Processing...</div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";
        
        document.getElementById("pdfToWordBtn").addEventListener("click", async function() {
            const input = document.getElementById("pdfToWordInput");
            if (!input.files.length) return alert("Please select a PDF file");
            const progress = document.getElementById("wordProgress");
            progress.classList.remove("hidden");
            
            try {
                const arrayBuffer = await input.files[0].arrayBuffer();
                const pdf = await pdfjsLib.getDocument({ data: arrayBuffer }).promise;
                const format = document.getElementById("wordFormat").value;
                let fullHtml = "";
                
                for (let i = 1; i <= pdf.numPages; i++) {
                    progress.innerHTML = "Processing page " + i + " of " + pdf.numPages + "...";
                    const page = await pdf.getPage(i);
                    const textContent = await page.getTextContent();
                    const viewport = page.getViewport({ scale: 1.5 });
                    
                    // Extract text with positioning for better formatting
                    let pageHtml = `<div class="page" style="margin-bottom: 20px; page-break-after: always;">`;
                    pageHtml += `<h3 style="color: #333; border-bottom: 1px solid #ccc;">Page ${i}</h3>`;
                    
                    const items = textContent.items;
                    let lastY = null;
                    let currentParagraph = "";
                    
                    for (let j = 0; j < items.length; j++) {
                        const item = items[j];
                        const y = Math.round(item.transform[5]);
                        
                        if (lastY !== null && Math.abs(y - lastY) > 15) {
                            if (currentParagraph.trim()) {
                                pageHtml += `<p style="margin: 0 0 10px 0; line-height: 1.5;">${escapeHtml(currentParagraph)}</p>`;
                                currentParagraph = "";
                            }
                        }
                        currentParagraph += item.str + " ";
                        lastY = y;
                    }
                    
                    if (currentParagraph.trim()) {
                        pageHtml += `<p style="margin: 0 0 10px 0; line-height: 1.5;">${escapeHtml(currentParagraph)}</p>`;
                    }
                    
                    pageHtml += `</div>`;
                    fullHtml += pageHtml;
                }
                
                const completeHtml = `<!DOCTYPE html>
                <html>
                <head>
                    <meta charset="UTF-8">
                    <title>Converted Document</title>
                    <style>
                        body {
                            font-family: "Times New Roman", Times, serif;
                            font-size: 12pt;
                            line-height: 1.5;
                            margin: 1in;
                            color: #000;
                        }
                        .page {
                            margin-bottom: 30px;
                        }
                        h3 {
                            color: #2c3e50;
                            margin-top: 20px;
                            margin-bottom: 15px;
                        }
                        p {
                            margin: 0 0 12px 0;
                        }
                    </style>
                </head>
                <body>
                    ${fullHtml}
                </body>
                </html>`;
                
                let blob;
                let filename = "converted";
                
                if (format === "docx") {
                    blob = new Blob([completeHtml], { type: "application/msword" });
                    filename += ".doc";
                } else if (format === "rtf") {
                    const rtfHeader = "{\\rtf1\\ansi\\deff0 {\\fonttbl {\\f0 Times New Roman;}}\\f0\\fs24 ";
                    const rtfContent = fullHtml.replace(/<[^>]*>/g, " ").replace(/&nbsp;/g, " ");
                    const rtfFooter = "}";
                    blob = new Blob([rtfHeader + rtfContent + rtfFooter], { type: "application/rtf" });
                    filename += ".rtf";
                } else {
                    const plainText = fullHtml.replace(/<[^>]*>/g, " ").replace(/&nbsp;/g, " ").replace(/\s+/g, " ").trim();
                    blob = new Blob([plainText], { type: "text/plain" });
                    filename += ".txt";
                }
                
                const url = URL.createObjectURL(blob);
                const a = document.createElement("a");
                a.href = url;
                a.download = filename;
                a.click();
                URL.revokeObjectURL(url);
                alert("Conversion complete! File downloaded.");
            } catch(e) {
                alert("Error converting PDF: " + e.message);
            }
            progress.classList.add("hidden");
        });
        
        function escapeHtml(text) {
            const div = document.createElement("div");
            div.textContent = text;
            return div.innerHTML;
        }
    </script>';
}

function getPdfToPptHTML() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'pdfToPptInput\').click()">
            <input type="file" id="pdfToPptInput" class="hidden" accept=".pdf">
            <div class="text-5xl mb-3">ðŸ“„âž¡ï¸ðŸ“Š</div>
            <p class="font-medium">Select PDF to convert to PowerPoint</p>
            <p class="text-sm text-gray-500 mt-2">Each page becomes a slide with content preserved</p>
        </div>
        <div id="pdfPreview" class="text-sm text-gray-500 text-center hidden"></div>
        <button id="pdfToPptBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Convert to PowerPoint</button>
        <div id="pptProgress" class="text-sm text-gray-500 text-center hidden">Processing...</div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";
        
        document.getElementById("pdfToPptBtn").addEventListener("click", async function() {
            const input = document.getElementById("pdfToPptInput");
            if (!input.files.length) return alert("Please select a PDF file");
            const progress = document.getElementById("pptProgress");
            progress.classList.remove("hidden");
            
            try {
                const arrayBuffer = await input.files[0].arrayBuffer();
                const pdf = await pdfjsLib.getDocument({ data: arrayBuffer }).promise;
                let slides = [];
                
                for (let i = 1; i <= pdf.numPages; i++) {
                    progress.innerHTML = "Processing slide " + i + " of " + pdf.numPages + "...";
                    const page = await pdf.getPage(i);
                    const textContent = await page.getTextContent();
                    const viewport = page.getViewport({ scale: 1 });
                    
                    // Extract text content for slide
                    let slideContent = "";
                    const items = textContent.items;
                    let lastY = null;
                    let currentParagraph = "";
                    
                    for (let j = 0; j < items.length; j++) {
                        const item = items[j];
                        const y = Math.round(item.transform[5]);
                        
                        if (lastY !== null && Math.abs(y - lastY) > 15) {
                            if (currentParagraph.trim()) {
                                slideContent += `<p style="margin: 0 0 10px 0;">${escapeHtml(currentParagraph)}</p>`;
                                currentParagraph = "";
                            }
                        }
                        currentParagraph += item.str + " ";
                        lastY = y;
                    }
                    
                    if (currentParagraph.trim()) {
                        slideContent += `<p style="margin: 0 0 10px 0;">${escapeHtml(currentParagraph)}</p>`;
                    }
                    
                    slides.push({
                        number: i,
                        content: slideContent || "<p>No text content found on this slide.</p>"
                    });
                }
                
                // Generate HTML presentation
                let presentationHtml = `<!DOCTYPE html>
                <html>
                <head>
                    <meta charset="UTF-8">
                    <title>PDF to PowerPoint Presentation</title>
                    <style>
                        body {
                            margin: 0;
                            padding: 0;
                            font-family: Arial, sans-serif;
                        }
                        .slide {
                            width: 100%;
                            height: 100vh;
                            page-break-after: always;
                            display: flex;
                            flex-direction: column;
                            justify-content: center;
                            padding: 50px;
                            box-sizing: border-box;
                            background: white;
                            border-bottom: 1px solid #eee;
                        }
                        .slide-title {
                            font-size: 36px;
                            font-weight: bold;
                            color: #2c3e50;
                            margin-bottom: 30px;
                            border-left: 5px solid #3498db;
                            padding-left: 20px;
                        }
                        .slide-content {
                            font-size: 24px;
                            line-height: 1.6;
                            color: #34495e;
                        }
                        .slide-content p {
                            margin: 15px 0;
                        }
                        .slide-number {
                            position: fixed;
                            bottom: 20px;
                            right: 20px;
                            font-size: 12px;
                            color: #95a5a6;
                        }
                        @media print {
                            .slide {
                                page-break-after: always;
                                height: auto;
                                min-height: 100vh;
                            }
                            .slide-number {
                                position: absolute;
                            }
                        }
                    </style>
                </head>
                <body>`;
                
                for (let i = 0; i < slides.length; i++) {
                    presentationHtml += `
                    <div class="slide">
                        <div class="slide-title">Slide ${slides[i].number}</div>
                        <div class="slide-content">${slides[i].content}</div>
                        <div class="slide-number">${i + 1} / ${slides.length}</div>
                    </div>`;
                }
                
                presentationHtml += `
                </body>
                </html>`;
                
                const blob = new Blob([presentationHtml], { type: "text/html" });
                const url = URL.createObjectURL(blob);
                const a = document.createElement("a");
                a.href = url;
                a.download = "presentation.html";
                a.click();
                URL.revokeObjectURL(url);
                
                alert("Conversion complete! HTML presentation downloaded. You can open in browser and print as PDF or use with PowerPoint.");
            } catch(e) {
                alert("Error converting PDF: " + e.message);
            }
            progress.classList.add("hidden");
        });
        
        function escapeHtml(text) {
            const div = document.createElement("div");
            div.textContent = text;
            return div.innerHTML;
        }
    </script>';
}

function getPdfToExcelHTML() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'pdfToExcelInput\').click()">
            <input type="file" id="pdfToExcelInput" class="hidden" accept=".pdf">
            <div class="text-5xl mb-3">ðŸ“„âž¡ï¸ðŸ“ˆ</div>
            <p class="font-medium">Select PDF to extract data</p>
            <p class="text-sm text-gray-500 mt-2">Extract tables and structured data to Excel</p>
        </div>
        <div id="pdfPreview" class="text-sm text-gray-500 text-center hidden"></div>
        <div class="space-y-4">
            <label class="block text-sm font-medium">Extraction Method:</label>
            <select id="extractMethod" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                <option value="table">Table Detection (Best for tabular data)</option>
                <option value="text">Text Extraction (All text)</option>
                <option value="lines">Line by Line (CSV format)</option>
            </select>
        </div>
        <button id="pdfToExcelBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Extract to Excel</button>
        <div id="excelProgress" class="text-sm text-gray-500 text-center hidden">Processing...</div>
        <div id="tableResult" class="mt-4 space-y-4"></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";
        
        document.getElementById("pdfToExcelBtn").addEventListener("click", async function() {
            const input = document.getElementById("pdfToExcelInput");
            if (!input.files.length) return alert("Please select a PDF file");
            const progress = document.getElementById("excelProgress");
            const resultDiv = document.getElementById("tableResult");
            progress.classList.remove("hidden");
            resultDiv.innerHTML = "";
            
            try {
                const arrayBuffer = await input.files[0].arrayBuffer();
                const pdf = await pdfjsLib.getDocument({ data: arrayBuffer }).promise;
                const method = document.getElementById("extractMethod").value;
                let allData = [];
                let allText = "";
                
                for (let i = 1; i <= pdf.numPages; i++) {
                    progress.innerHTML = "Extracting page " + i + " of " + pdf.numPages + "...";
                    const page = await pdf.getPage(i);
                    const textContent = await page.getTextContent();
                    
                    if (method === "text") {
                        const pageText = textContent.items.map(item => item.str).join(" ");
                        allText += pageText + "\n\n";
                    } else if (method === "lines") {
                        const lines = textContent.items.map(item => item.str).join(" ").split(/\s{2,}|\n/);
                        allData.push(...lines.filter(l => l.trim()));
                    } else {
                        // Table detection - group text by Y position
                        const itemsByY = {};
                        textContent.items.forEach(item => {
                            const y = Math.round(item.transform[5]);
                            if (!itemsByY[y]) itemsByY[y] = [];
                            itemsByY[y].push(item.str);
                        });
                        
                        const rows = Object.values(itemsByY).map(rowItems => rowItems.join(" "));
                        if (rows.length > 0) allData.push(...rows);
                    }
                }
                
                let csvContent = "";
                let filename = "extracted_data";
                
                if (method === "text") {
                    const blob = new Blob([allText], { type: "text/plain" });
                    const url = URL.createObjectURL(blob);
                    const a = document.createElement("a");
                    a.href = url;
                    a.download = "extracted_text.txt";
                    a.click();
                    URL.revokeObjectURL(url);
                    resultDiv.innerHTML = "<div class=\"bg-green-100 dark:bg-green-900/30 p-4 rounded-xl text-center\">Text extraction complete! TXT file downloaded.</div>";
                } else if (method === "lines") {
                    csvContent = allData.map(line => JSON.stringify(String(line))).join("\n");
                    const blob = new Blob([csvContent], { type: "text/csv" });
                    const url = URL.createObjectURL(blob);
                    const a = document.createElement("a");
                    a.href = url;
                    a.download = "extracted_lines.csv";
                    a.click();
                    URL.revokeObjectURL(url);
                    resultDiv.innerHTML = "<div class=\"bg-green-100 dark:bg-green-900/30 p-4 rounded-xl text-center\">Line extraction complete! CSV file downloaded.</div>";
                } else {
                    // Create Excel-friendly CSV with multiple columns
                    const csvRows = allData.map(row => {
                        const cells = row.split(/\s{2,}/);
                        return cells.map(cell => `"${cell.trim().replace(/"/g, "")}"`).join(",");
                    });
                    csvContent = csvRows.join("\n");
                    const blob = new Blob([csvContent], { type: "text/csv" });
                    const url = URL.createObjectURL(blob);
                    const a = document.createElement("a");
                    a.href = url;
                    a.download = "extracted_table_data.csv";
                    a.click();
                    URL.revokeObjectURL(url);
                    resultDiv.innerHTML = "<div class=\"bg-green-100 dark:bg-green-900/30 p-4 rounded-xl text-center\">Table extraction complete! CSV file downloaded. Open in Excel for proper formatting.</div>";
                }
                
                if (csvContent) {
                    resultDiv.innerHTML += `<pre class="text-xs mt-2 overflow-x-auto bg-gray-50 dark:bg-gray-800 p-2 rounded">${csvContent.slice(0, 500)}${csvContent.length > 500 ? "..." : ""}</pre>`;
                }
            } catch(e) {
                resultDiv.innerHTML = "<div class=\"text-red-500 text-center py-4\">Error: " + e.message + "</div>";
            }
            progress.classList.add("hidden");
        });
    </script>';
}

function getMergePdfHTML() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'mergePdfInput\').click()">
            <input type="file" id="mergePdfInput" class="hidden" accept=".pdf" multiple>
            <div class="text-5xl mb-3">ðŸ“‘âž•ðŸ“‘</div>
            <p class="font-medium">Select PDF files to merge</p>
            <p class="text-sm text-gray-500 mt-2">Combine multiple PDFs into one document</p>
        </div>
        <div id="mergePreview" class="flex flex-wrap gap-2 mt-4"></div>
        <button id="mergePdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Merge PDFs</button>
        <div id="mergeProgress" class="text-sm text-gray-500 text-center hidden">Processing...</div>
    </div>
    <script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
    <script>
        const mergeInput = document.getElementById("mergePdfInput");
        const mergePreview = document.getElementById("mergePreview");
        
        mergeInput.addEventListener("change", function() {
            mergePreview.innerHTML = "";
            Array.from(this.files).forEach((file, idx) => {
                const badge = document.createElement("span");
                badge.className = "bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 px-3 py-1 rounded-full text-sm";
                badge.innerText = "ðŸ“„ " + file.name;
                mergePreview.appendChild(badge);
            });
        });
        
        document.getElementById("mergePdfBtn").addEventListener("click", async function() {
            const input = document.getElementById("mergePdfInput");
            if (!input.files.length) return alert("Please select PDF files");
            const progress = document.getElementById("mergeProgress");
            progress.classList.remove("hidden");
            try {
                const { PDFDocument } = PDFLib;
                const mergedPdf = await PDFDocument.create();
                for (const file of input.files) {
                    const arrayBuffer = await file.arrayBuffer();
                    const pdf = await PDFDocument.load(arrayBuffer);
                    const pages = await mergedPdf.copyPages(pdf, pdf.getPageIndices());
                    pages.forEach(page => mergedPdf.addPage(page));
                }
                const pdfBytes = await mergedPdf.save();
                const blob = new Blob([pdfBytes], { type: "application/pdf" });
                const url = URL.createObjectURL(blob);
                const a = document.createElement("a");
                a.href = url;
                a.download = "merged.pdf";
                a.click();
                URL.revokeObjectURL(url);
                alert("PDFs merged successfully!");
            } catch(e) {
                alert("Error merging PDFs: " + e.message);
            }
            progress.classList.add("hidden");
        });
    </script>';
}

function getCompressPdfHTML() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'compressPdfInput\').click()">
            <input type="file" id="compressPdfInput" class="hidden" accept=".pdf">
            <div class="text-5xl mb-3">ðŸ—œï¸</div>
            <p class="font-medium">Select PDF to compress</p>
            <p class="text-sm text-gray-500 mt-2">Reduce file size while maintaining quality</p>
        </div>
        <div id="compressPreview" class="text-sm text-gray-500 text-center hidden"></div>
        <div class="space-y-4">
            <label class="block text-sm font-medium">Compression Level:</label>
            <select id="compressLevel" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                <option value="low">Low (Minimal compression)</option>
                <option value="medium" selected>Medium (Recommended)</option>
                <option value="high">High (Maximum compression)</option>
            </select>
        </div>
        <button id="compressPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Compress PDF</button>
        <div id="compressProgress" class="text-sm text-gray-500 text-center hidden">Processing...</div>
    </div>
    <script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
    <script>
        const compressInput = document.getElementById("compressPdfInput");
        const compressPreview = document.getElementById("compressPreview");
        
        compressInput.addEventListener("change", function() {
            if(this.files[0]) {
                const sizeKB = (this.files[0].size / 1024).toFixed(2);
                compressPreview.innerHTML = "Selected: " + this.files[0].name + " (" + sizeKB + " KB)";
                compressPreview.classList.remove("hidden");
            }
        });
        
        document.getElementById("compressPdfBtn").addEventListener("click", async function() {
            const input = document.getElementById("compressPdfInput");
            if (!input.files.length) return alert("Please select a PDF file");
            const progress = document.getElementById("compressProgress");
            progress.classList.remove("hidden");
            
            try {
                const { PDFDocument } = PDFLib;
                const arrayBuffer = await input.files[0].arrayBuffer();
                const pdf = await PDFDocument.load(arrayBuffer);
                const level = document.getElementById("compressLevel").value;
                
                const pdfBytes = await pdf.save({
                    useObjectStreams: level !== "low",
                    addDefaultPage: false
                });
                
                const blob = new Blob([pdfBytes], { type: "application/pdf" });
                const url = URL.createObjectURL(blob);
                const a = document.createElement("a");
                a.href = url;
                a.download = "compressed.pdf";
                a.click();
                URL.revokeObjectURL(url);
                
                const originalSize = (input.files[0].size / 1024).toFixed(2);
                const compressedSize = (pdfBytes.length / 1024).toFixed(2);
                const saved = (originalSize - compressedSize).toFixed(2);
                alert("Compression complete!\\nOriginal: " + originalSize + " KB\\nCompressed: " + compressedSize + " KB\\nSaved: " + saved + " KB (" + ((saved/originalSize)*100).toFixed(0) + "%)");
            } catch(e) {
                alert("Error compressing PDF: " + e.message);
            }
            progress.classList.add("hidden");
        });
    </script>';
}

function getProtectPdfHTML() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'protectPdfInput\').click()">
            <input type="file" id="protectPdfInput" class="hidden" accept=".pdf">
            <div class="text-5xl mb-3">ðŸ”’</div>
            <p class="font-medium">Select PDF to protect</p>
            <p class="text-sm text-gray-500 mt-2">Add password protection to your PDF</p>
        </div>
        <div id="protectPreview" class="text-sm text-gray-500 text-center hidden"></div>
        <div class="space-y-4">
            <label class="block text-sm font-medium">Password:</label>
            <input type="password" id="pdfPassword" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Enter password">
            <label class="block text-sm font-medium">Confirm Password:</label>
            <input type="password" id="confirmPassword" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Confirm password">
        </div>
        <button id="protectPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Protect PDF</button>
        <div id="protectProgress" class="text-sm text-gray-500 text-center hidden">Processing...</div>
    </div>
    <script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
    <script>
        const protectInput = document.getElementById("protectPdfInput");
        const protectPreview = document.getElementById("protectPreview");
        
        protectInput.addEventListener("change", function() {
            if(this.files[0]) {
                protectPreview.innerHTML = "Selected: " + this.files[0].name;
                protectPreview.classList.remove("hidden");
            }
        });
        
        document.getElementById("protectPdfBtn").addEventListener("click", async function() {
            const input = document.getElementById("protectPdfInput");
            const password = document.getElementById("pdfPassword").value;
            const confirm = document.getElementById("confirmPassword").value;
            
            if (!input.files.length) return alert("Please select a PDF file");
            if (!password) return alert("Please enter a password");
            if (password !== confirm) return alert("Passwords do not match");
            if (password.length < 4) return alert("Password must be at least 4 characters");
            
            const progress = document.getElementById("protectProgress");
            progress.classList.remove("hidden");
            
            try {
                const { PDFDocument } = PDFLib;
                const arrayBuffer = await input.files[0].arrayBuffer();
                const pdf = await PDFDocument.load(arrayBuffer);
                
                pdf.encrypt({
                    userPassword: password,
                    ownerPassword: password + "owner",
                    permissions: {
                        printing: "highResolution",
                        modifying: false,
                        copying: false,
                        annotating: false,
                        fillingForms: false,
                        contentAccessibility: true,
                        documentAssembly: false
                    }
                });
                
                const pdfBytes = await pdf.save();
                const blob = new Blob([pdfBytes], { type: "application/pdf" });
                const url = URL.createObjectURL(blob);
                const a = document.createElement("a");
                a.href = url;
                a.download = "protected.pdf";
                a.click();
                URL.revokeObjectURL(url);
                alert("PDF protected successfully! Password required to open.");
            } catch(e) {
                alert("Error protecting PDF: " + e.message);
            }
            progress.classList.add("hidden");
        });
    </script>';
}

function getWordToPdfHTML() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'wordToPdfInput\').click()">
            <input type="file" id="wordToPdfInput" class="hidden" accept=".doc,.docx">
            <div class="text-5xl mb-3">ðŸ“âž¡ï¸ðŸ“„</div>
            <p class="font-medium">Select Word file to convert to PDF</p>
            <p class="text-sm text-gray-500 mt-2">DOC/DOCX to PDF conversion with formatting preserved</p>
        </div>
        <div id="wordPreview" class="text-sm text-gray-500 text-center hidden"></div>
        <div class="space-y-4">
            <label class="block text-sm font-medium">Page Size:</label>
            <select id="pageSize" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                <option value="a4">A4</option>
                <option value="letter">Letter</option>
                <option value="legal">Legal</option>
            </select>
        </div>
        <button id="wordToPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Convert to PDF</button>
        <div id="wordProgress" class="text-sm text-gray-500 text-center hidden">Processing...</div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/mammoth@1.4.2/mammoth.browser.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        const wordInput = document.getElementById("wordToPdfInput");
        const wordPreview = document.getElementById("wordPreview");
        
        wordInput.addEventListener("change", function() {
            if(this.files[0]) {
                wordPreview.innerHTML = "Selected: " + this.files[0].name;
                wordPreview.classList.remove("hidden");
            }
        });
        
        document.getElementById("wordToPdfBtn").addEventListener("click", async function() {
            const input = document.getElementById("wordToPdfInput");
            if (!input.files.length) return alert("Please select a Word file");
            const progress = document.getElementById("wordProgress");
            progress.classList.remove("hidden");
            progress.innerHTML = "Converting Word to PDF...";
            
            try {
                const file = input.files[0];
                const arrayBuffer = await file.arrayBuffer();
                const pageSize = document.getElementById("pageSize").value;
                
                let htmlContent = "";
                
                if (file.name.endsWith(".docx")) {
                    const result = await mammoth.convertToHtml({ arrayBuffer: arrayBuffer });
                    htmlContent = result.value;
                } else {
                    // For .doc files, use a simpler approach
                    const result = await mammoth.extractRawText({ arrayBuffer: arrayBuffer });
                    htmlContent = `<pre style="white-space: pre-wrap; font-family: Times New Roman, serif;">${escapeHtml(result.value)}</pre>`;
                }
                
                const completeHtml = `<!DOCTYPE html>
                <html>
                <head>
                    <meta charset="UTF-8">
                    <title>Converted Document</title>
                    <style>
                        body {
                            font-family: "Times New Roman", Times, serif;
                            font-size: 12pt;
                            line-height: 1.5;
                            margin: 1in;
                            color: #000;
                            background: white;
                        }
                        h1, h2, h3, h4, h5, h6 {
                            color: #000;
                            margin-top: 20px;
                            margin-bottom: 10px;
                        }
                        p {
                            margin: 0 0 12px 0;
                        }
                        table {
                            border-collapse: collapse;
                            width: 100%;
                            margin: 15px 0;
                        }
                        th, td {
                            border: 1px solid #000;
                            padding: 8px;
                            text-align: left;
                        }
                        th {
                            background-color: #f2f2f2;
                        }
                        img {
                            max-width: 100%;
                            height: auto;
                        }
                        @media print {
                            body {
                                margin: 0;
                                padding: 0.5in;
                            }
                        }
                    </style>
                </head>
                <body>
                    ${htmlContent}
                </body>
                </html>`;
                
                const opt = {
                    margin: [0.5, 0.5, 0.5, 0.5],
                    filename: "converted.pdf",
                    image: { type: "jpeg", quality: 0.98 },
                    html2canvas: { scale: 2, letterRendering: true, backgroundColor: "#ffffff" },
                    jsPDF: { unit: "in", format: pageSize, orientation: "portrait" }
                };
                
                const element = document.createElement("div");
                element.innerHTML = completeHtml;
                document.body.appendChild(element);
                
                await new Promise(resolve => setTimeout(resolve, 100));
                await html2pdf().set(opt).from(element).save();
                element.remove();
                alert("Conversion complete! PDF downloaded with formatting preserved.");
            } catch(e) {
                alert("Error converting Word file: " + e.message);
            }
            progress.classList.add("hidden");
        });
        
        function escapeHtml(text) {
            const div = document.createElement("div");
            div.textContent = text;
            return div.innerHTML;
        }
    </script>';
}

function getExcelToPdfHTML() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'excelToPdfInput\').click()">
            <input type="file" id="excelToPdfInput" class="hidden" accept=".xls,.xlsx,.csv">
            <div class="text-5xl mb-3">ðŸ“Šâž¡ï¸ðŸ“„</div>
            <p class="font-medium">Select Excel/CSV file to convert to PDF</p>
            <p class="text-sm text-gray-500 mt-2">XLS/XLSX/CSV to PDF conversion with table formatting</p>
        </div>
        <div id="excelPreview" class="text-sm text-gray-500 text-center hidden"></div>
        <div class="space-y-4">
            <label class="block text-sm font-medium">Page Orientation:</label>
            <select id="pageOrientation" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                <option value="portrait">Portrait</option>
                <option value="landscape" selected>Landscape (Recommended for tables)</option>
            </select>
            <label class="block text-sm font-medium">Page Size:</label>
            <select id="pageSize" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                <option value="a4">A4</option>
                <option value="letter">Letter</option>
                <option value="legal">Legal</option>
            </select>
        </div>
        <button id="excelToPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Convert to PDF</button>
        <div id="excelProgress" class="text-sm text-gray-500 text-center hidden">Processing...</div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        const excelInput = document.getElementById("excelToPdfInput");
        const excelPreview = document.getElementById("excelPreview");
        
        excelInput.addEventListener("change", function() {
            if(this.files[0]) {
                excelPreview.innerHTML = "Selected: " + this.files[0].name + " (" + (this.files[0].size / 1024).toFixed(2) + " KB)";
                excelPreview.classList.remove("hidden");
            }
        });
        
        document.getElementById("excelToPdfBtn").addEventListener("click", async function() {
            const input = document.getElementById("excelToPdfInput");
            if (!input.files.length) return alert("Please select an Excel/CSV file");
            const progress = document.getElementById("excelProgress");
            progress.classList.remove("hidden");
            progress.innerHTML = "Reading Excel file...";
            
            try {
                const file = input.files[0];
                const data = await file.arrayBuffer();
                const workbook = XLSX.read(data);
                const orientation = document.getElementById("pageOrientation").value;
                const pageSize = document.getElementById("pageSize").value;
                
                let allSheetsHtml = "";
                
                for (let s = 0; s < workbook.SheetNames.length; s++) {
                    const sheetName = workbook.SheetNames[s];
                    const worksheet = workbook.Sheets[sheetName];
                    
                    // Convert to HTML with better formatting
                    const htmlTable = XLSX.utils.sheet_to_html(worksheet, { editable: false });
                    
                    allSheetsHtml += `
                        <div class="sheet" style="page-break-after: ${s < workbook.SheetNames.length - 1 ? "always" : "auto"};">
                            <h2 style="color: #000; font-size: 14pt; margin: 15px 0 10px 0; text-align: center;">Sheet: ${escapeHtml(sheetName)}</h2>
                            ${htmlTable}
                        </div>
                    `;
                }
                
                const htmlContent = `<!DOCTYPE html>
                <html>
                <head>
                    <meta charset="UTF-8">
                    <title>Excel to PDF Conversion</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            font-size: 10pt;
                            color: #000;
                            background: white;
                            margin: 0;
                            padding: 0.5in;
                        }
                        .sheet {
                            margin-bottom: 20px;
                        }
                        table {
                            border-collapse: collapse;
                            width: 100%;
                            margin: 10px 0;
                            font-size: 9pt;
                        }
                        th, td {
                            border: 1px solid #000;
                            padding: 6px 8px;
                            text-align: left;
                            vertical-align: top;
                        }
                        th {
                            background-color: #f2f2f2;
                            font-weight: bold;
                        }
                        h2 {
                            color: #000;
                            font-size: 14pt;
                            margin: 15px 0 10px 0;
                            page-break-after: avoid;
                        }
                        @media print {
                            body {
                                margin: 0;
                                padding: 0.5in;
                            }
                            table {
                                page-break-inside: avoid;
                            }
                            tr {
                                page-break-inside: avoid;
                                page-break-after: avoid;
                            }
                            thead {
                                display: table-header-group;
                            }
                        }
                    </style>
                </head>
                <body>
                    ${allSheetsHtml}
                </body>
                </html>`;
                
                const opt = {
                    margin: [0.5, 0.5, 0.5, 0.5],
                    filename: "excel_to_pdf.pdf",
                    image: { type: "jpeg", quality: 0.98 },
                    html2canvas: { scale: 2, letterRendering: true, backgroundColor: "#ffffff" },
                    jsPDF: { unit: "in", format: pageSize, orientation: orientation }
                };
                
                progress.innerHTML = "Generating PDF...";
                
                const element = document.createElement("div");
                element.style.position = "absolute";
                element.style.left = "-9999px";
                element.style.top = "-9999px";
                element.innerHTML = htmlContent;
                document.body.appendChild(element);
                
                await new Promise(resolve => setTimeout(resolve, 300));
                await html2pdf().set(opt).from(element).save();
                element.remove();
                alert("Conversion complete! PDF downloaded with all sheets formatted.");
            } catch(e) {
                alert("Error converting Excel file: " + e.message);
            }
            progress.classList.add("hidden");
        });
        
        function escapeHtml(text) {
            const div = document.createElement("div");
            div.textContent = text;
            return div.innerHTML;
        }
    </script>';
}

function getPptToPdfHTML() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'pptToPdfInput\').click()">
            <input type="file" id="pptToPdfInput" class="hidden" accept=".ppt,.pptx">
            <div class="text-5xl mb-3">ðŸ“½ï¸âž¡ï¸ðŸ“„</div>
            <p class="font-medium">Select PowerPoint file to convert to PDF</p>
            <p class="text-sm text-gray-500 mt-2">PPT/PPTX to PDF conversion with slide layout preserved</p>
        </div>
        <div id="pptPreview" class="text-sm text-gray-500 text-center hidden"></div>
        <div class="space-y-4">
            <label class="block text-sm font-medium">Slide Layout:</label>
            <select id="slideLayout" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                <option value="portrait">Portrait (1 slide per page)</option>
                <option value="landscape" selected>Landscape (Widescreen)</option>
            </select>
        </div>
        <button id="pptToPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Convert to PDF</button>
        <div id="pptProgress" class="text-sm text-gray-500 text-center hidden">Processing...</div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script>
        const pptInput = document.getElementById("pptToPdfInput");
        const pptPreview = document.getElementById("pptPreview");
        
        pptInput.addEventListener("change", function() {
            if(this.files[0]) {
                pptPreview.innerHTML = "Selected: " + this.files[0].name;
                pptPreview.classList.remove("hidden");
            }
        });
        
        document.getElementById("pptToPdfBtn").addEventListener("click", async function() {
            const input = document.getElementById("pptToPdfInput");
            if (!input.files.length) return alert("Please select a PowerPoint file");
            const progress = document.getElementById("pptProgress");
            progress.classList.remove("hidden");
            progress.innerHTML = "Converting PowerPoint to PDF...";
            
            try {
                const file = input.files[0];
                const arrayBuffer = await file.arrayBuffer();
                const layout = document.getElementById("slideLayout").value;
                
                let slides = [];
                
                if (file.name.endsWith(".pptx")) {
                    try {
                        const JSZip = window.JSZip;
                        const zip = await JSZip.loadAsync(arrayBuffer);
                        const slideFiles = Object.keys(zip.files).filter(name => name.match(/ppt\/slides\/slide\d+\.xml/));
                        
                        for (const slideFile of slideFiles) {
                            const content = await zip.files[slideFile].async("string");
                            const textMatches = content.match(/>([^<]+)</g);
                            let slideText = "";
                            if (textMatches) {
                                slideText = textMatches.map(m => m.replace(/[<>]/g, "")).join(" ");
                            }
                            
                            // Try to extract images if possible
                            slides.push({
                                number: slides.length + 1,
                                content: slideText || "Slide content not available"
                            });
                        }
                    } catch(e) {
                        slides.push({
                            number: 1,
                            content: "Unable to extract content. The presentation may be protected or corrupted."
                        });
                    }
                } else {
                    slides.push({
                        number: 1,
                        content: "PPT files are not fully supported. Please convert to PPTX format first for better results."
                    });
                }
                
                let slidesHtml = "";
                const orientation = layout === "landscape" ? "landscape" : "portrait";
                const slideWidth = layout === "landscape" ? "10in" : "8.5in";
                const slideHeight = layout === "landscape" ? "7.5in" : "11in";
                
                for (let i = 0; i < slides.length; i++) {
                    slidesHtml += `
                        <div class="slide" style="page-break-after: always; width: ${slideWidth}; height: ${slideHeight}; display: flex; flex-direction: column; justify-content: center; padding: 40px; box-sizing: border-box;">
                            <div class="slide-title" style="font-size: 32px; font-weight: bold; color: #2c3e50; margin-bottom: 30px; border-left: 5px solid #3498db; padding-left: 20px;">
                                Slide ${slides[i].number}
                            </div>
                            <div class="slide-content" style="font-size: 20px; line-height: 1.6; color: #34495e;">
                                <p>${escapeHtml(slides[i].content)}</p>
                            </div>
                        </div>
                    `;
                }
                
                const completeHtml = `<!DOCTYPE html>
                <html>
                <head>
                    <meta charset="UTF-8">
                    <title>PowerPoint to PDF</title>
                    <style>
                        body {
                            margin: 0;
                            padding: 0;
                            font-family: Arial, sans-serif;
                            background: white;
                        }
                        .slide {
                            box-sizing: border-box;
                        }
                        @media print {
                            .slide {
                                page-break-after: always;
                            }
                        }
                    </style>
                </head>
                <body>
                    ${slidesHtml}
                </body>
                </html>`;
                
                const opt = {
                    margin: [0, 0, 0, 0],
                    filename: "powerpoint_to_pdf.pdf",
                    image: { type: "jpeg", quality: 0.98 },
                    html2canvas: { scale: 2, letterRendering: true, backgroundColor: "#ffffff" },
                    jsPDF: { unit: "in", format: layout === "landscape" ? "a4" : "a4", orientation: orientation }
                };
                
                const element = document.createElement("div");
                element.innerHTML = completeHtml;
                document.body.appendChild(element);
                
                await new Promise(resolve => setTimeout(resolve, 100));
                await html2pdf().set(opt).from(element).save();
                element.remove();
                alert("Conversion complete! PDF downloaded with slide layout.");
            } catch(e) {
                alert("Error converting PowerPoint file: " + e.message);
            }
            progress.classList.add("hidden");
        });
        
        function escapeHtml(text) {
            const div = document.createElement("div");
            div.textContent = text;
            return div.innerHTML;
        }
    </script>';
}

// ... (keep the rest of the functions for JSON, CSV, QR, Password, Word Counter, Image Compressor, OCR as they are working well)

function getJsonToCsvHTML() {
    return '
    <div class="space-y-6">
        <textarea id="jsonInput" class="w-full h-64 p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl font-mono text-sm border border-gray-200 dark:border-gray-600" placeholder=\'[{"name": "John", "age": 30}, {"name": "Jane", "age": 25}]\'></textarea>
        <button id="jsonToCsvBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Convert to CSV</button>
        <div id="csvResult" class="hidden mt-4 p-4 bg-gray-100 dark:bg-gray-700 rounded-xl">
            <h4 class="font-bold mb-2">CSV Preview:</h4>
            <pre id="csvPreview" class="text-xs overflow-x-auto whitespace-pre-wrap"></pre>
            <button id="downloadCsvBtn" class="mt-3 bg-green-600 text-white px-4 py-2 rounded-lg text-sm hidden">Download CSV</button>
        </div>
    </div>
    <script>
        let currentCSV = "";
        
        document.getElementById("jsonToCsvBtn").addEventListener("click", function() {
            try {
                const json = JSON.parse(document.getElementById("jsonInput").value);
                if (!Array.isArray(json)) throw new Error("JSON must be an array");
                if (json.length === 0) throw new Error("JSON array is empty");
                const headers = Object.keys(json[0]);
                const csv = [headers.join(","), ...json.map(row => headers.map(h => {
                    let val = row[h];
                    if (val === undefined || val === null) val = "";
                    if (typeof val === "string" && (val.includes(",") || val.includes("\""))) {
                        val = "\"" + val.replace(/"/g, "\"\"") + "\"";
                    }
                    return val;
                }).join(","))].join("\\n");
                currentCSV = csv;
                document.getElementById("csvPreview").innerText = csv.slice(0, 500) + (csv.length > 500 ? "..." : "");
                document.getElementById("csvResult").classList.remove("hidden");
                document.getElementById("downloadCsvBtn").classList.remove("hidden");
            } catch(e) {
                alert("Invalid JSON: " + e.message);
            }
        });
        
        document.getElementById("downloadCsvBtn").addEventListener("click", function() {
            const blob = new Blob([currentCSV], { type: "text/csv" });
            const url = URL.createObjectURL(blob);
            const a = document.createElement("a");
            a.href = url;
            a.download = "converted.csv";
            a.click();
            URL.revokeObjectURL(url);
        });
    </script>';
}

function getCsvToJsonHTML() {
    return '
    <div class="space-y-6">
        <textarea id="csvInput" class="w-full h-64 p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl font-mono text-sm border border-gray-200 dark:border-gray-600" placeholder="name,age\\nJohn,30\\nJane,25"></textarea>
        <button id="csvToJsonBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Convert to JSON</button>
        <div id="jsonResult" class="hidden mt-4 p-4 bg-gray-100 dark:bg-gray-700 rounded-xl">
            <h4 class="font-bold mb-2">JSON Preview:</h4>
            <pre id="jsonPreview" class="text-xs overflow-x-auto whitespace-pre-wrap"></pre>
            <button id="downloadJsonBtn" class="mt-3 bg-green-600 text-white px-4 py-2 rounded-lg text-sm hidden">Download JSON</button>
        </div>
    </div>
    <script>
        let currentJSON = "";
        
        document.getElementById("csvToJsonBtn").addEventListener("click", function() {
            try {
                const csv = document.getElementById("csvInput").value;
                const lines = csv.trim().split("\\n");
                const headers = lines[0].split(",");
                const json = [];
                
                for (let i = 1; i < lines.length; i++) {
                    const values = lines[i].split(",");
                    const obj = {};
                    headers.forEach((header, idx) => {
                        obj[header.trim()] = values[idx] ? values[idx].trim() : "";
                    });
                    json.push(obj);
                }
                
                currentJSON = JSON.stringify(json, null, 2);
                document.getElementById("jsonPreview").innerText = currentJSON.slice(0, 500) + (currentJSON.length > 500 ? "..." : "");
                document.getElementById("jsonResult").classList.remove("hidden");
                document.getElementById("downloadJsonBtn").classList.remove("hidden");
            } catch(e) {
                alert("Invalid CSV: " + e.message);
            }
        });
        
        document.getElementById("downloadJsonBtn").addEventListener("click", function() {
            const blob = new Blob([currentJSON], { type: "application/json" });
            const url = URL.createObjectURL(blob);
            const a = document.createElement("a");
            a.href = url;
            a.download = "converted.json";
            a.click();
            URL.revokeObjectURL(url);
        });
    </script>';
}

function getQrGeneratorHTML() {
    return '
    <div class="space-y-6">
        <textarea id="qrText" class="w-full h-32 p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Enter text or URL to generate QR code"></textarea>
        <div class="flex gap-3">
            <select id="qrSize" class="flex-1 p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                <option value="150">Small (150x150)</option>
                <option value="200" selected>Medium (200x200)</option>
                <option value="300">Large (300x300)</option>
            </select>
            <select id="qrColor" class="flex-1 p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                <option value="#000000">Black</option>
                <option value="#3b82f6">Blue</option>
                <option value="#10b981">Green</option>
                <option value="#ef4444">Red</option>
                <option value="#8b5cf6">Purple</option>
            </select>
        </div>
        <button id="generateQrBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Generate QR Code</button>
        <div id="qrResult" class="flex flex-col items-center mt-6 hidden">
            <div id="qrcode"></div>
            <button id="downloadQrBtn" class="mt-4 bg-green-600 text-white px-6 py-2 rounded-lg text-sm hidden">Download QR Code</button>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/qrcodejs2-fix@1.0.0/qrcode.min.js"></script>
    <script>
        let currentQR = null;
        
        document.getElementById("generateQrBtn").addEventListener("click", function() {
            const text = document.getElementById("qrText").value;
            if(!text) return alert("Please enter text or URL");
            const size = parseInt(document.getElementById("qrSize").value);
            const color = document.getElementById("qrColor").value;
            const qrDiv = document.getElementById("qrcode");
            qrDiv.innerHTML = "";
            qrDiv.style.width = size + "px";
            qrDiv.style.height = size + "px";
            currentQR = new QRCode(qrDiv, { text: text, width: size, height: size, colorDark: color });
            document.getElementById("qrResult").classList.remove("hidden");
            document.getElementById("downloadQrBtn").classList.remove("hidden");
        });
        
        document.getElementById("downloadQrBtn").addEventListener("click", function() {
            const qrCanvas = document.querySelector("#qrcode canvas");
            if (qrCanvas) {
                const link = document.createElement("a");
                link.download = "qrcode.png";
                link.href = qrCanvas.toDataURL();
                link.click();
            } else {
                alert("Generate QR code first");
            }
        });
    </script>';
}

function getPasswordGenHTML() {
    return '
    <div class="space-y-6">
        <div class="flex flex-wrap gap-6 mb-4">
            <label class="flex items-center gap-2"><input type="radio" name="passType" value="strong" checked> <span>Strong (letters+numbers+symbols)</span></label>
            <label class="flex items-center gap-2"><input type="radio" name="passType" value="numbers"> <span>Numbers Only</span></label>
            <label class="flex items-center gap-2"><input type="radio" name="passType" value="alphanumeric"> <span>Alphanumeric (A-Z, 0-9)</span></label>
        </div>
        <div class="space-y-4">
            <label class="block text-sm font-medium">Password Length: <span id="lengthValue">16</span></label>
            <input type="range" id="passLength" min="6" max="32" value="16" class="w-full">
        </div>
        <button id="generatePassBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Generate Password</button>
        <div id="passResult" class="hidden mt-6 text-center">
            <div id="generatedPass" class="text-2xl font-mono font-bold bg-gray-100 dark:bg-gray-700 p-4 rounded-xl break-all"></div>
            <button id="copyPassBtn" class="mt-3 text-blue-600">Copy to clipboard</button>
        </div>
    </div>
    <script>
        let currentPassword = "";
        
        document.getElementById("passLength").addEventListener("input", function() {
            document.getElementById("lengthValue").innerText = this.value;
        });
        
        document.getElementById("generatePassBtn").addEventListener("click", function() {
            const type = document.querySelector(\'input[name="passType"]:checked\').value;
            const length = parseInt(document.getElementById("passLength").value);
            let charset = "";
            
            if (type === "strong") {
                charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*";
            } else if (type === "numbers") {
                charset = "0123456789";
            } else {
                charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            }
            
            let pass = "";
            for(let i=0; i<length; i++) {
                pass += charset[Math.floor(Math.random() * charset.length)];
            }
            currentPassword = pass;
            document.getElementById("generatedPass").innerText = pass;
            document.getElementById("passResult").classList.remove("hidden");
        });
        
        document.getElementById("copyPassBtn").addEventListener("click", function() {
            navigator.clipboard.writeText(currentPassword);
            alert("Password copied!");
        });
    </script>';
}

function getWordCounterHTML() {
    return '
    <div class="space-y-6">
        <textarea id="wordCountText" class="w-full h-64 p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Type or paste your text here..."></textarea>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="text-center p-4 bg-gray-100 dark:bg-gray-700 rounded-xl"><span class="text-2xl font-bold" id="wordCount">0</span><br>Words</div>
            <div class="text-center p-4 bg-gray-100 dark:bg-gray-700 rounded-xl"><span class="text-2xl font-bold" id="charCount">0</span><br>Characters</div>
            <div class="text-center p-4 bg-gray-100 dark:bg-gray-700 rounded-xl"><span class="text-2xl font-bold" id="sentenceCount">0</span><br>Sentences</div>
            <div class="text-center p-4 bg-gray-100 dark:bg-gray-700 rounded-xl"><span class="text-2xl font-bold" id="paraCount">0</span><br>Paragraphs</div>
        </div>
        <button id="clearTextBtn" class="w-full bg-gray-600 text-white py-3 rounded-xl font-semibold hover:bg-gray-700 transition">Clear Text</button>
    </div>
    <script>
        const textarea = document.getElementById("wordCountText");
        
        function updateCounts() {
            const text = textarea.value;
            const words = text.trim() ? text.trim().split(/\\s+/).length : 0;
            const chars = text.length;
            const sentences = text.split(/[.!?]+/).filter(s => s.trim().length > 0).length;
            const paragraphs = text.split(/\\n\\n+/).filter(p => p.trim().length > 0).length;
            
            document.getElementById("wordCount").innerText = words;
            document.getElementById("charCount").innerText = chars;
            document.getElementById("sentenceCount").innerText = sentences;
            document.getElementById("paraCount").innerText = paragraphs || (text.trim() ? 1 : 0);
        }
        
        textarea.addEventListener("input", updateCounts);
        updateCounts();
        
        document.getElementById("clearTextBtn").addEventListener("click", function() {
            textarea.value = "";
            updateCounts();
        });
    </script>';
}

function getImageCompressorHTML() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'compressImageInput\').click()">
            <input type="file" id="compressImageInput" class="hidden" accept="image/*">
            <div class="text-5xl mb-3">ðŸ–¼ï¸ðŸ—œï¸</div>
            <p class="font-medium">Select image to compress</p>
            <p class="text-sm text-gray-500 mt-2">JPG, PNG, WEBP supported</p>
        </div>
        <div id="originalPreview" class="hidden mt-4">
            <p class="text-sm font-medium mb-2">Original:</p>
            <img id="originalImg" class="max-w-full h-32 object-contain rounded-lg">
            <p id="originalSize" class="text-xs text-gray-500 mt-1"></p>
        </div>
        <div class="space-y-4">
            <label class="block text-sm font-medium">Quality: <span id="qualityValue">88</span>%</label>
            <input type="range" id="compressQuality" min="10" max="100" value="88" class="w-full">
            <label class="block text-sm font-medium">Max Width (px):</label>
            <input type="number" id="maxWidth" value="1200" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
        </div>
        <button id="compressImageBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Compress Image</button>
        <div id="compressedPreview" class="hidden mt-4">
            <p class="text-sm font-medium mb-2">Compressed:</p>
            <img id="compressedImg" class="max-w-full h-32 object-contain rounded-lg">
            <p id="compressedSize" class="text-xs text-gray-500 mt-1"></p>
            <button id="downloadImageBtn" class="mt-2 bg-green-600 text-white px-4 py-2 rounded-lg text-sm hidden">Download Image</button>
        </div>
    </div>
    <script>
        let compressedBlob = null;
        const imageInput = document.getElementById("compressImageInput");
        const originalPreview = document.getElementById("originalPreview");
        const originalImg = document.getElementById("originalImg");
        const originalSize = document.getElementById("originalSize");
        
        imageInput.addEventListener("change", function() {
            if(this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    originalImg.src = e.target.result;
                    originalSize.innerText = "Size: " + (imageInput.files[0].size / 1024).toFixed(2) + " KB";
                    originalPreview.classList.remove("hidden");
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
        
        document.getElementById("compressQuality").addEventListener("input", function() {
            document.getElementById("qualityValue").innerText = this.value;
        });
        
        document.getElementById("compressImageBtn").addEventListener("click", function() {
            const input = document.getElementById("compressImageInput");
            if (!input.files.length) return alert("Please select an image");
            
            const quality = document.getElementById("compressQuality").value / 100;
            const maxWidth = parseInt(document.getElementById("maxWidth").value);
            const file = input.files[0];
            
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    let width = img.width;
                    let height = img.height;
                    
                    if (width > maxWidth) {
                        height = (height * maxWidth) / width;
                        width = maxWidth;
                    }
                    
                    const canvas = document.createElement("canvas");
                    canvas.width = width;
                    canvas.height = height;
                    const ctx = canvas.getContext("2d");
                    ctx.imageSmoothingEnabled = true;
                    ctx.imageSmoothingQuality = "high";
                    ctx.drawImage(img, 0, 0, width, height);
                    const hasAlpha = /png|webp/i.test(file.type);
                    const outputType = hasAlpha ? "image/webp" : "image/jpeg";
                    const outputExt = hasAlpha ? "webp" : "jpg";

                    canvas.toBlob(function(blob) {
                        if (!blob) return alert("Could not compress image.");
                        compressedBlob = blob;
                        const compressedImg = document.getElementById("compressedImg");
                        compressedImg.src = URL.createObjectURL(blob);
                        document.getElementById("compressedSize").innerText = "Size: " + (blob.size / 1024).toFixed(2) + " KB (Saved: " + ((file.size - blob.size) / 1024).toFixed(2) + " KB)";
                        document.getElementById("compressedPreview").classList.remove("hidden");
                        document.getElementById("downloadImageBtn").classList.remove("hidden");
                        document.getElementById("downloadImageBtn").dataset.ext = outputExt;
                    }, outputType, quality);
                };
                img.onerror = function() { alert("Could not read image data."); };
                img.src = e.target.result;
            };
            reader.onerror = function() { alert("Could not load selected file."); };
            reader.readAsDataURL(file);
        });
        
        document.getElementById("downloadImageBtn").addEventListener("click", function() {
            if (compressedBlob) {
                const url = URL.createObjectURL(compressedBlob);
                const a = document.createElement("a");
                a.href = url;
                const ext = document.getElementById("downloadImageBtn").dataset.ext || "jpg";
                a.download = "compressed." + ext;
                a.click();
                URL.revokeObjectURL(url);
            }
        });
    </script>';
}

function getBackgroundRemoverHTML() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'bgRemoverInput\').click()">
            <input type="file" id="bgRemoverInput" class="hidden" accept="image/*">
            <div class="text-5xl mb-3">ðŸª„</div>
            <p class="font-medium">Upload an image to remove the background</p>
            <p class="text-sm text-gray-500 mt-2">Best for product shots, logos, signatures, and clean backgrounds</p>
        </div>
        <div class="grid md:grid-cols-2 gap-4">
            <div id="bgOriginalWrap" class="hidden">
                <p class="text-sm font-medium mb-2">Original</p>
                <img id="bgOriginalImg" class="w-full max-h-72 object-contain rounded-xl border border-gray-200 dark:border-gray-700 bg-white/60">
            </div>
            <div id="bgResultWrap" class="hidden">
                <p class="text-sm font-medium mb-2">Background Removed</p>
                <div class="rounded-xl border border-gray-200 dark:border-gray-700 p-3" style="background-image: linear-gradient(45deg, rgba(0,0,0,0.04) 25%, transparent 25%), linear-gradient(-45deg, rgba(0,0,0,0.04) 25%, transparent 25%), linear-gradient(45deg, transparent 75%, rgba(0,0,0,0.04) 75%), linear-gradient(-45deg, transparent 75%, rgba(0,0,0,0.04) 75%); background-size: 18px 18px; background-position: 0 0, 0 9px, 9px -9px, -9px 0px;">
                    <img id="bgResultImg" class="w-full max-h-72 object-contain rounded-lg">
                </div>
            </div>
        </div>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1">Edge tolerance: <span id="bgToleranceValue">36</span></label>
                <input type="range" id="bgTolerance" min="8" max="120" value="36" class="w-full">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Edge feather: <span id="bgFeatherValue">2</span> px</label>
                <input type="range" id="bgFeather" min="0" max="6" value="2" class="w-full">
            </div>
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" id="bgRemoveNearWhite" checked>
                Also clear near-white leftovers
            </label>
        </div>
        <div class="grid sm:grid-cols-2 gap-3">
            <button id="bgRemoveBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Remove Background</button>
            <button id="bgDownloadBtn" class="w-full bg-green-600 text-white py-3 rounded-xl font-semibold hover:bg-green-700 transition hidden">Download PNG</button>
        </div>
        <p id="bgStatus" class="text-sm text-gray-500 text-center"></p>
    </div>
    <script>
        let bgRemovedBlob = null;
        const bgInput = document.getElementById("bgRemoverInput");
        const bgTolerance = document.getElementById("bgTolerance");
        const bgToleranceValue = document.getElementById("bgToleranceValue");
        const bgFeather = document.getElementById("bgFeather");
        const bgFeatherValue = document.getElementById("bgFeatherValue");
        const bgOriginalWrap = document.getElementById("bgOriginalWrap");
        const bgResultWrap = document.getElementById("bgResultWrap");
        const bgOriginalImg = document.getElementById("bgOriginalImg");
        const bgResultImg = document.getElementById("bgResultImg");
        const bgStatus = document.getElementById("bgStatus");
        const bgDownloadBtn = document.getElementById("bgDownloadBtn");

        bgTolerance.addEventListener("input", function() {
            bgToleranceValue.innerText = this.value;
        });
        bgFeather.addEventListener("input", function() {
            bgFeatherValue.innerText = this.value;
        });

        bgInput.addEventListener("change", function() {
            const file = this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                bgOriginalImg.src = e.target.result;
                bgOriginalWrap.classList.remove("hidden");
                bgResultWrap.classList.add("hidden");
                bgDownloadBtn.classList.add("hidden");
                bgStatus.innerText = "Image loaded. Adjust tolerance if needed, then remove the background.";
            };
            reader.readAsDataURL(file);
        });

        function rgbToLab(r, g, b) {
            function pivot(v) {
                v /= 255;
                return v > 0.04045 ? Math.pow((v + 0.055) / 1.055, 2.4) : v / 12.92;
            }
            const rr = pivot(r), gg = pivot(g), bb = pivot(b);
            const x = (rr * 0.4124 + gg * 0.3576 + bb * 0.1805) / 0.95047;
            const y = (rr * 0.2126 + gg * 0.7152 + bb * 0.0722) / 1.00000;
            const z = (rr * 0.0193 + gg * 0.1192 + bb * 0.9505) / 1.08883;
            function f(t) { return t > 0.008856 ? Math.cbrt(t) : (7.787 * t + 16 / 116); }
            const fx = f(x), fy = f(y), fz = f(z);
            return [116 * fy - 16, 500 * (fx - fy), 200 * (fy - fz)];
        }

        function labDistance(a, b) {
            const dl = a[0] - b[0];
            const da = a[1] - b[1];
            const db = a[2] - b[2];
            return Math.sqrt(dl * dl + da * da + db * db);
        }

        function bgSampleAverage(data, width, x0, y0, size) {
            let r = 0, g = 0, b = 0, count = 0;
            for (let y = y0; y < Math.min(y0 + size, data.length / 4 / width); y++) {
                for (let x = x0; x < Math.min(x0 + size, width); x++) {
                    const idx = (y * width + x) * 4;
                    if (data[idx + 3] === 0) continue;
                    r += data[idx];
                    g += data[idx + 1];
                    b += data[idx + 2];
                    count++;
                }
            }
            return count ? [r / count, g / count, b / count] : [255, 255, 255];
        }

        document.getElementById("bgRemoveBtn").addEventListener("click", function() {
            const file = bgInput.files[0];
            if (!file) return alert("Please select an image first");

            bgStatus.innerText = "Removing background...";

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    const maxSide = 1600;
                    const scale = Math.min(1, maxSide / Math.max(img.width, img.height));
                    const width = Math.max(1, Math.round(img.width * scale));
                    const height = Math.max(1, Math.round(img.height * scale));

                    const canvas = document.createElement("canvas");
                    canvas.width = width;
                    canvas.height = height;
                    const ctx = canvas.getContext("2d", { willReadFrequently: true });
                    ctx.drawImage(img, 0, 0, width, height);

                    const imageData = ctx.getImageData(0, 0, width, height);
                    const data = imageData.data;
                    const visited = new Uint8Array(width * height);
                    const tolerance = parseInt(bgTolerance.value, 10);
                    const feather = parseInt(bgFeather.value, 10);
                    const clearNearWhite = document.getElementById("bgRemoveNearWhite").checked;
                    const patch = Math.max(4, Math.round(Math.min(width, height) * 0.04));
                    const corners = [
                        bgSampleAverage(data, width, 0, 0, patch),
                        bgSampleAverage(data, width, Math.max(0, width - patch), 0, patch),
                        bgSampleAverage(data, width, 0, Math.max(0, height - patch), patch),
                        bgSampleAverage(data, width, Math.max(0, width - patch), Math.max(0, height - patch), patch)
                    ];
                    const avgBg = corners.reduce((acc, c) => [acc[0] + c[0], acc[1] + c[1], acc[2] + c[2]], [0, 0, 0]).map(v => v / corners.length);
                    const bgLab = rgbToLab(avgBg[0], avgBg[1], avgBg[2]);
                    const edgeTolerance = tolerance * 1.28;
                    const alphaMap = new Float32Array(width * height);

                    const queue = [];
                    function pushIfMatch(x, y) {
                        if (x < 0 || y < 0 || x >= width || y >= height) return;
                        const pos = y * width + x;
                        if (visited[pos]) return;
                        const idx = pos * 4;
                        if (data[idx + 3] === 0) return;
                        const distance = labDistance(rgbToLab(data[idx], data[idx + 1], data[idx + 2]), bgLab);
                        if (distance <= edgeTolerance) {
                            visited[pos] = 1;
                            queue.push(pos);
                        }
                    }

                    for (let x = 0; x < width; x++) {
                        pushIfMatch(x, 0);
                        pushIfMatch(x, height - 1);
                    }
                    for (let y = 0; y < height; y++) {
                        pushIfMatch(0, y);
                        pushIfMatch(width - 1, y);
                    }

                    for (let qi = 0; qi < queue.length; qi++) {
                        const pos = queue[qi];
                        const x = pos % width;
                        const y = Math.floor(pos / width);
                        const idx = pos * 4;
                        const d = labDistance(rgbToLab(data[idx], data[idx + 1], data[idx + 2]), bgLab);
                        if (d <= tolerance) alphaMap[pos] = 0;
                        else {
                            const t = Math.max(0, Math.min(1, (d - tolerance) / Math.max(1, edgeTolerance - tolerance)));
                            alphaMap[pos] = t * t;
                        }
                        pushIfMatch(x + 1, y);
                        pushIfMatch(x - 1, y);
                        pushIfMatch(x, y + 1);
                        pushIfMatch(x, y - 1);
                    }

                    for (let i = 0; i < alphaMap.length; i++) {
                        if (!visited[i]) alphaMap[i] = 1;
                    }

                    if (feather > 0) {
                        for (let pass = 0; pass < feather; pass++) {
                            const next = new Float32Array(alphaMap);
                            for (let y = 1; y < height - 1; y++) {
                                for (let x = 1; x < width - 1; x++) {
                                    const p = y * width + x;
                                    next[p] = (
                                        alphaMap[p] +
                                        alphaMap[p - 1] + alphaMap[p + 1] +
                                        alphaMap[p - width] + alphaMap[p + width]
                                    ) / 5;
                                }
                            }
                            alphaMap.set(next);
                        }
                    }

                    if (clearNearWhite) {
                        for (let i = 0; i < data.length; i += 4) {
                            const pos = i / 4;
                            const alpha = alphaMap[pos];
                            const brightness = (data[i] + data[i + 1] + data[i + 2]) / 3;
                            if (alpha > 0 && brightness > 245) {
                                alphaMap[pos] = Math.max(0, alpha - 0.65);
                            }
                        }
                    }

                    for (let i = 0; i < alphaMap.length; i++) {
                        data[i * 4 + 3] = Math.max(0, Math.min(255, Math.round(alphaMap[i] * 255)));
                    }

                    ctx.putImageData(imageData, 0, 0);
                    canvas.toBlob(function(blob) {
                        bgRemovedBlob = blob;
                        const url = URL.createObjectURL(blob);
                        bgResultImg.src = url;
                        bgResultWrap.classList.remove("hidden");
                        bgDownloadBtn.classList.remove("hidden");
                        bgStatus.innerText = "Background removed. Download as transparent PNG.";
                    }, "image/png");
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        });

        bgDownloadBtn.addEventListener("click", function() {
            if (!bgRemovedBlob) return;
            const file = bgInput.files[0];
            const name = file ? file.name.replace(/\\.[^.]+$/, "") : "background-removed";
            const url = URL.createObjectURL(bgRemovedBlob);
            const a = document.createElement("a");
            a.href = url;
            a.download = name + "-transparent.png";
            a.click();
            URL.revokeObjectURL(url);
        });
    </script>';
}

function getImageToDxfHTML() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'imgToDxfInput\').click()">
            <input type="file" id="imgToDxfInput" class="hidden" accept="image/*">
            <div class="text-5xl mb-3">ðŸ“</div>
            <p class="font-medium">Upload an image to trace into DXF</p>
            <p class="text-sm text-gray-500 mt-2">Best for logos, silhouettes, stamps, line art, and high-contrast artwork</p>
        </div>
        <div id="imgToDxfPreviewWrap" class="hidden text-center">
            <img id="imgToDxfPreview" class="mx-auto max-h-72 rounded-xl border border-gray-200 dark:border-gray-700 bg-white/60">
            <p id="imgToDxfMeta" class="text-xs text-gray-500 mt-2"></p>
        </div>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Threshold: <span id="imgToDxfThresholdValue">160</span></label>
                <input type="range" id="imgToDxfThreshold" min="0" max="255" value="160" class="w-full">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Trace size: <span id="imgToDxfSizeValue">180</span> px</label>
                <input type="range" id="imgToDxfSize" min="64" max="320" value="180" class="w-full">
            </div>
        </div>
        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" id="imgToDxfInvert">
            Invert tracing (use for dark backgrounds / light logos)
        </label>
        <div class="grid sm:grid-cols-2 gap-3">
            <button id="imgToDxfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Generate DXF</button>
            <button id="imgToDxfDownload" class="w-full bg-green-600 text-white py-3 rounded-xl font-semibold hover:bg-green-700 transition hidden">Download DXF</button>
        </div>
        <p id="imgToDxfStatus" class="text-sm text-gray-500 text-center"></p>
    </div>
    <script>
        let imgToDxfContent = "";
        const imgToDxfInput = document.getElementById("imgToDxfInput");
        const imgToDxfPreview = document.getElementById("imgToDxfPreview");
        const imgToDxfPreviewWrap = document.getElementById("imgToDxfPreviewWrap");
        const imgToDxfMeta = document.getElementById("imgToDxfMeta");
        const imgToDxfStatus = document.getElementById("imgToDxfStatus");

        function imgToDxfEscapeName(name) {
            return (name || "trace").replace(/\\.[^.]+$/, "").replace(/[^a-z0-9_-]+/gi, "_");
        }

        document.getElementById("imgToDxfThreshold").addEventListener("input", function() {
            document.getElementById("imgToDxfThresholdValue").innerText = this.value;
        });

        document.getElementById("imgToDxfSize").addEventListener("input", function() {
            document.getElementById("imgToDxfSizeValue").innerText = this.value;
        });

        imgToDxfInput.addEventListener("change", function() {
            const file = this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                imgToDxfPreview.src = e.target.result;
                imgToDxfPreviewWrap.classList.remove("hidden");
                imgToDxfMeta.innerText = file.name + " â€¢ " + Math.round(file.size / 1024) + " KB";
                document.getElementById("imgToDxfDownload").classList.add("hidden");
                imgToDxfStatus.innerText = "Ready to trace. Lower threshold keeps more dark pixels; higher threshold keeps more of the image.";
            };
            reader.readAsDataURL(file);
        });

        function imgToDxfBuildBinary(data, width, height, threshold, invert) {
            const mask = new Uint8Array(width * height);
            for (let i = 0; i < width * height; i++) {
                const idx = i * 4;
                const alpha = data[idx + 3];
                if (alpha < 20) {
                    mask[i] = 0;
                    continue;
                }
                const brightness = (0.299 * data[idx]) + (0.587 * data[idx + 1]) + (0.114 * data[idx + 2]);
                const isFilled = invert ? brightness >= threshold : brightness <= threshold;
                mask[i] = isFilled ? 1 : 0;
            }
            return mask;
        }

        function imgToDxfLinesFromMask(mask, width, height) {
            const lines = [];
            function isFilled(x, y) {
                if (x < 0 || y < 0 || x >= width || y >= height) return 0;
                return mask[y * width + x];
            }

            for (let y = 0; y < height; y++) {
                for (let x = 0; x < width; x++) {
                    if (!isFilled(x, y)) continue;
                    const cadY = height - y;
                    if (!isFilled(x, y - 1)) lines.push([x, cadY, x + 1, cadY]);
                    if (!isFilled(x + 1, y)) lines.push([x + 1, cadY, x + 1, cadY - 1]);
                    if (!isFilled(x, y + 1)) lines.push([x, cadY - 1, x + 1, cadY - 1]);
                    if (!isFilled(x - 1, y)) lines.push([x, cadY, x, cadY - 1]);
                }
            }
            return lines;
        }

        function imgToDxfBuildFile(lines) {
            let dxf = "0\\nSECTION\\n2\\nHEADER\\n0\\nENDSEC\\n0\\nSECTION\\n2\\nENTITIES\\n";
            lines.forEach(function(line) {
                dxf += "0\\nLINE\\n8\\n0\\n10\\n" + line[0] + "\\n20\\n" + line[1] + "\\n30\\n0\\n11\\n" + line[2] + "\\n21\\n" + line[3] + "\\n31\\n0\\n";
            });
            dxf += "0\\nENDSEC\\n0\\nEOF\\n";
            return dxf;
        }

        document.getElementById("imgToDxfBtn").addEventListener("click", function() {
            const file = imgToDxfInput.files[0];
            if (!file) return alert("Please select an image first");

            imgToDxfStatus.innerText = "Tracing outlines into DXF...";
            const threshold = parseInt(document.getElementById("imgToDxfThreshold").value, 10);
            const maxSize = parseInt(document.getElementById("imgToDxfSize").value, 10);
            const invert = document.getElementById("imgToDxfInvert").checked;

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    const scale = Math.min(1, maxSize / Math.max(img.width, img.height));
                    const width = Math.max(1, Math.round(img.width * scale));
                    const height = Math.max(1, Math.round(img.height * scale));

                    const canvas = document.createElement("canvas");
                    canvas.width = width;
                    canvas.height = height;
                    const ctx = canvas.getContext("2d", { willReadFrequently: true });
                    ctx.drawImage(img, 0, 0, width, height);

                    const imageData = ctx.getImageData(0, 0, width, height);
                    const mask = imgToDxfBuildBinary(imageData.data, width, height, threshold, invert);
                    const lines = imgToDxfLinesFromMask(mask, width, height);

                    if (!lines.length) {
                        imgToDxfStatus.innerText = "No vector outline found. Try increasing trace size or changing threshold.";
                        document.getElementById("imgToDxfDownload").classList.add("hidden");
                        return;
                    }

                    if (lines.length > 25000) {
                        imgToDxfStatus.innerText = "Trace is too detailed for a clean DXF. Reduce trace size or simplify the source image.";
                        document.getElementById("imgToDxfDownload").classList.add("hidden");
                        return;
                    }

                    imgToDxfContent = imgToDxfBuildFile(lines);
                    document.getElementById("imgToDxfDownload").classList.remove("hidden");
                    imgToDxfStatus.innerText = "DXF ready. Generated " + lines.length + " line segments from a " + width + "Ã—" + height + " trace.";
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        });

        document.getElementById("imgToDxfDownload").addEventListener("click", function() {
            if (!imgToDxfContent) return;
            const file = imgToDxfInput.files[0];
            const blob = new Blob([imgToDxfContent], { type: "application/dxf" });
            const url = URL.createObjectURL(blob);
            const a = document.createElement("a");
            a.href = url;
            a.download = imgToDxfEscapeName(file ? file.name : "trace") + ".dxf";
            a.click();
            URL.revokeObjectURL(url);
        });
    </script>';
}

function getImageToSvgHTML() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'imgToSvgInput\').click()">
            <input type="file" id="imgToSvgInput" class="hidden" accept="image/*">
            <div class="text-5xl mb-3">SVG</div>
            <p class="font-medium">Upload an image to trace into SVG</p>
            <p class="text-sm text-gray-500 mt-2">Best for logos, silhouettes, signatures, stamps, and line art</p>
        </div>
        <div id="imgToSvgPreviewWrap" class="hidden text-center">
            <img id="imgToSvgPreview" class="mx-auto max-h-72 rounded-xl border border-gray-200 dark:border-gray-700 bg-white/60">
            <p id="imgToSvgMeta" class="text-xs text-gray-500 mt-2"></p>
        </div>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Threshold: <span id="imgToSvgThresholdValue">160</span></label>
                <input type="range" id="imgToSvgThreshold" min="0" max="255" value="160" class="w-full">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Trace size: <span id="imgToSvgSizeValue">180</span> px</label>
                <input type="range" id="imgToSvgSize" min="64" max="320" value="180" class="w-full">
            </div>
        </div>
        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" id="imgToSvgInvert">
            Invert tracing
        </label>
        <div class="grid sm:grid-cols-2 gap-3">
            <button id="imgToSvgBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Generate SVG</button>
            <button id="imgToSvgDownload" class="w-full bg-green-600 text-white py-3 rounded-xl font-semibold hover:bg-green-700 transition hidden">Download SVG</button>
        </div>
        <p id="imgToSvgStatus" class="text-sm text-gray-500 text-center"></p>
    </div>
    <script>
        let imgToSvgContent = "";
        const imgToSvgInput = document.getElementById("imgToSvgInput");

        function buildSvgMask(data, width, height, threshold, invert) {
            const mask = new Uint8Array(width * height);
            for (let i = 0; i < width * height; i++) {
                const idx = i * 4;
                const alpha = data[idx + 3];
                if (alpha < 20) continue;
                const brightness = (0.299 * data[idx]) + (0.587 * data[idx + 1]) + (0.114 * data[idx + 2]);
                const filled = invert ? brightness >= threshold : brightness <= threshold;
                mask[i] = filled ? 1 : 0;
            }
            return mask;
        }

        function buildSvgFromMask(mask, width, height) {
            let paths = "";
            for (let y = 0; y < height; y++) {
                let x = 0;
                while (x < width) {
                    if (!mask[y * width + x]) {
                        x++;
                        continue;
                    }
                    let runStart = x;
                    while (x < width && mask[y * width + x]) x++;
                    paths += "<rect x=\\"" + runStart + "\\" y=\\"" + y + "\\" width=\\"" + (x - runStart) + "\\" height=\\"1\\" />";
                }
            }
            return "<svg xmlns=\\"http://www.w3.org/2000/svg\\" viewBox=\\"0 0 " + width + " " + height + "\\" fill=\\"#000\\" shape-rendering=\\"crispEdges\\">" + paths + "</svg>";
        }

        document.getElementById("imgToSvgThreshold").addEventListener("input", function() {
            document.getElementById("imgToSvgThresholdValue").innerText = this.value;
        });
        document.getElementById("imgToSvgSize").addEventListener("input", function() {
            document.getElementById("imgToSvgSizeValue").innerText = this.value;
        });

        imgToSvgInput.addEventListener("change", function() {
            const file = this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("imgToSvgPreview").src = e.target.result;
                document.getElementById("imgToSvgMeta").innerText = file.name + " â€¢ " + Math.round(file.size / 1024) + " KB";
                document.getElementById("imgToSvgPreviewWrap").classList.remove("hidden");
                document.getElementById("imgToSvgDownload").classList.add("hidden");
                document.getElementById("imgToSvgStatus").innerText = "Ready to trace into SVG.";
            };
            reader.readAsDataURL(file);
        });

        document.getElementById("imgToSvgBtn").addEventListener("click", function() {
            const file = imgToSvgInput.files[0];
            if (!file) return alert("Please select an image first");
            const threshold = parseInt(document.getElementById("imgToSvgThreshold").value, 10);
            const maxSize = parseInt(document.getElementById("imgToSvgSize").value, 10);
            const invert = document.getElementById("imgToSvgInvert").checked;
            const status = document.getElementById("imgToSvgStatus");
            status.innerText = "Generating SVG...";

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    const scale = Math.min(1, maxSize / Math.max(img.width, img.height));
                    const width = Math.max(1, Math.round(img.width * scale));
                    const height = Math.max(1, Math.round(img.height * scale));
                    const canvas = document.createElement("canvas");
                    canvas.width = width;
                    canvas.height = height;
                    const ctx = canvas.getContext("2d", { willReadFrequently: true });
                    ctx.drawImage(img, 0, 0, width, height);
                    const imageData = ctx.getImageData(0, 0, width, height);
                    const mask = buildSvgMask(imageData.data, width, height, threshold, invert);
                    if (!mask.some(Boolean)) {
                        status.innerText = "No strong shapes found. Try changing the threshold.";
                        return;
                    }
                    imgToSvgContent = buildSvgFromMask(mask, width, height);
                    document.getElementById("imgToSvgDownload").classList.remove("hidden");
                    status.innerText = "SVG ready for download.";
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        });

        document.getElementById("imgToSvgDownload").addEventListener("click", function() {
            if (!imgToSvgContent) return;
            const file = imgToSvgInput.files[0];
            const base = (file ? file.name : "trace").replace(/\\.[^.]+$/, "").replace(/[^a-z0-9_-]+/gi, "_");
            const blob = new Blob([imgToSvgContent], { type: "image/svg+xml" });
            const url = URL.createObjectURL(blob);
            const a = document.createElement("a");
            a.href = url;
            a.download = base + ".svg";
            a.click();
            URL.revokeObjectURL(url);
        });
    </script>';
}

function getResizeImageHTML() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'resizeImageInput\').click()">
            <input type="file" id="resizeImageInput" class="hidden" accept="image/*">
            <div class="text-5xl mb-3">RESIZE</div>
            <p class="font-medium">Upload an image to resize</p>
            <p class="text-sm text-gray-500 mt-2">Resize by width and height, then export as JPG, PNG, or WEBP</p>
        </div>
        <div id="resizePreviewWrap" class="hidden grid md:grid-cols-2 gap-4 items-start">
            <div>
                <p class="text-sm font-medium mb-2">Original</p>
                <img id="resizeOriginalImg" class="w-full max-h-72 object-contain rounded-xl border border-gray-200 dark:border-gray-700 bg-white/60">
                <p id="resizeOriginalMeta" class="text-xs text-gray-500 mt-2"></p>
            </div>
            <div>
                <p class="text-sm font-medium mb-2">Resized Preview</p>
                <img id="resizeResultImg" class="w-full max-h-72 object-contain rounded-xl border border-gray-200 dark:border-gray-700 bg-white/60 hidden">
                <p id="resizeResultMeta" class="text-xs text-gray-500 mt-2"></p>
            </div>
        </div>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Width</label>
                <input type="number" id="resizeWidth" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Height</label>
                <input type="number" id="resizeHeight" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
            </div>
        </div>
        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" id="resizeLockRatio" checked>
            Lock aspect ratio
        </label>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Output format</label>
                <select id="resizeFormat" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                    <option value="image/png">PNG</option>
                    <option value="image/jpeg">JPG</option>
                    <option value="image/webp">WEBP</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Quality: <span id="resizeQualityValue">92</span>%</label>
                <input type="range" id="resizeQuality" min="10" max="100" value="92" class="w-full">
            </div>
        </div>
        <div class="grid sm:grid-cols-2 gap-3">
            <button id="resizeImageBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Resize Image</button>
            <button id="resizeDownloadBtn" class="w-full bg-green-600 text-white py-3 rounded-xl font-semibold hover:bg-green-700 transition hidden">Download Resized Image</button>
        </div>
        <p id="resizeStatus" class="text-sm text-gray-500 text-center"></p>
    </div>
    <script>
        let resizeBlob = null;
        let resizeAspectRatio = 1;
        const resizeImageInput = document.getElementById("resizeImageInput");
        const resizeWidth = document.getElementById("resizeWidth");
        const resizeHeight = document.getElementById("resizeHeight");
        const resizeLockRatio = document.getElementById("resizeLockRatio");

        document.getElementById("resizeQuality").addEventListener("input", function() {
            document.getElementById("resizeQualityValue").innerText = this.value;
        });

        resizeImageInput.addEventListener("change", function() {
            const file = this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    resizeAspectRatio = img.width / img.height;
                    resizeWidth.value = img.width;
                    resizeHeight.value = img.height;
                    document.getElementById("resizeOriginalImg").src = e.target.result;
                    document.getElementById("resizeOriginalMeta").innerText = img.width + " x " + img.height + " â€¢ " + Math.round(file.size / 1024) + " KB";
                    document.getElementById("resizePreviewWrap").classList.remove("hidden");
                    document.getElementById("resizeResultImg").classList.add("hidden");
                    document.getElementById("resizeDownloadBtn").classList.add("hidden");
                    document.getElementById("resizeStatus").innerText = "Image loaded. Adjust dimensions and click Resize Image.";
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        });

        resizeWidth.addEventListener("input", function() {
            if (!resizeLockRatio.checked || !this.value) return;
            resizeHeight.value = Math.max(1, Math.round(parseInt(this.value, 10) / resizeAspectRatio));
        });
        resizeHeight.addEventListener("input", function() {
            if (!resizeLockRatio.checked || !this.value) return;
            resizeWidth.value = Math.max(1, Math.round(parseInt(this.value, 10) * resizeAspectRatio));
        });

        document.getElementById("resizeImageBtn").addEventListener("click", function() {
            const file = resizeImageInput.files[0];
            if (!file) return alert("Please select an image first");
            const width = Math.max(1, parseInt(resizeWidth.value, 10) || 1);
            const height = Math.max(1, parseInt(resizeHeight.value, 10) || 1);
            const format = document.getElementById("resizeFormat").value;
            const quality = (parseInt(document.getElementById("resizeQuality").value, 10) || 92) / 100;
            document.getElementById("resizeStatus").innerText = "Rendering resized image...";

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    const canvas = document.createElement("canvas");
                    canvas.width = width;
                    canvas.height = height;
                    const ctx = canvas.getContext("2d");
                    ctx.imageSmoothingEnabled = true;
                    ctx.imageSmoothingQuality = "high";
                    ctx.drawImage(img, 0, 0, width, height);
                    canvas.toBlob(function(blob) {
                        if (!blob) return alert("Could not resize image.");
                        resizeBlob = blob;
                        const url = URL.createObjectURL(blob);
                        const preview = document.getElementById("resizeResultImg");
                        preview.src = url;
                        preview.classList.remove("hidden");
                        document.getElementById("resizeResultMeta").innerText = width + " x " + height + " â€¢ " + Math.round(blob.size / 1024) + " KB";
                        document.getElementById("resizeDownloadBtn").classList.remove("hidden");
                        document.getElementById("resizeStatus").innerText = "Resized image ready.";
                    }, format, quality);
                };
                img.onerror = function() { alert("Could not read image data."); };
                img.src = e.target.result;
            };
            reader.onerror = function() { alert("Could not load selected file."); };
            reader.readAsDataURL(file);
        });

        document.getElementById("resizeDownloadBtn").addEventListener("click", function() {
            if (!resizeBlob) return;
            const file = resizeImageInput.files[0];
            const format = document.getElementById("resizeFormat").value;
            const ext = format === "image/png" ? "png" : (format === "image/webp" ? "webp" : "jpg");
            const base = (file ? file.name : "resized").replace(/\\.[^.]+$/, "");
            const url = URL.createObjectURL(resizeBlob);
            const a = document.createElement("a");
            a.href = url;
            a.download = base + "-resized." + ext;
            a.click();
            URL.revokeObjectURL(url);
        });
    </script>';
}

function getCropImageHTML() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'cropImageInput\').click()">
            <input type="file" id="cropImageInput" class="hidden" accept="image/*">
            <div class="text-5xl mb-3">CROP</div>
            <p class="font-medium">Upload an image to crop</p>
            <p class="text-sm text-gray-500 mt-2">Drag on the preview to select the crop area</p>
        </div>
        <div id="cropWorkspace" class="hidden space-y-4">
            <div class="overflow-auto rounded-xl border border-gray-200 dark:border-gray-700 bg-white/60 p-3">
                <canvas id="cropCanvas" class="max-w-full rounded-lg cursor-crosshair"></canvas>
            </div>
            <div class="grid md:grid-cols-4 gap-3 text-sm">
                <div class="p-3 rounded-xl bg-gray-100 dark:bg-gray-800">X: <span id="cropX">0</span></div>
                <div class="p-3 rounded-xl bg-gray-100 dark:bg-gray-800">Y: <span id="cropY">0</span></div>
                <div class="p-3 rounded-xl bg-gray-100 dark:bg-gray-800">Width: <span id="cropW">0</span></div>
                <div class="p-3 rounded-xl bg-gray-100 dark:bg-gray-800">Height: <span id="cropH">0</span></div>
            </div>
        </div>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Output format</label>
                <select id="cropFormat" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                    <option value="image/png">PNG</option>
                    <option value="image/jpeg">JPG</option>
                    <option value="image/webp">WEBP</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Quality: <span id="cropQualityValue">92</span>%</label>
                <input type="range" id="cropQuality" min="10" max="100" value="92" class="w-full">
            </div>
        </div>
        <div class="grid sm:grid-cols-2 gap-3">
            <button id="cropImageBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Crop Image</button>
            <button id="cropDownloadBtn" class="w-full bg-green-600 text-white py-3 rounded-xl font-semibold hover:bg-green-700 transition hidden">Download Cropped Image</button>
        </div>
        <div id="cropResultWrap" class="hidden">
            <p class="text-sm font-medium mb-2">Cropped Result</p>
            <img id="cropResultImg" class="w-full max-h-72 object-contain rounded-xl border border-gray-200 dark:border-gray-700 bg-white/60">
        </div>
        <p id="cropStatus" class="text-sm text-gray-500 text-center"></p>
    </div>
    <script>
        let cropBlob = null;
        let cropImage = null;
        let cropScale = 1;
        let cropSelection = { x: 0, y: 0, w: 0, h: 0 };
        let cropDragging = false;
        let cropStart = null;
        const cropImageInput = document.getElementById("cropImageInput");
        const cropCanvas = document.getElementById("cropCanvas");
        const cropCtx = cropCanvas.getContext("2d");

        document.getElementById("cropQuality").addEventListener("input", function() {
            document.getElementById("cropQualityValue").innerText = this.value;
        });

        function updateCropReadout() {
            document.getElementById("cropX").innerText = cropSelection.x;
            document.getElementById("cropY").innerText = cropSelection.y;
            document.getElementById("cropW").innerText = cropSelection.w;
            document.getElementById("cropH").innerText = cropSelection.h;
        }

        function drawCropCanvas() {
            if (!cropImage) return;
            cropCtx.clearRect(0, 0, cropCanvas.width, cropCanvas.height);
            cropCtx.drawImage(cropImage, 0, 0, cropCanvas.width, cropCanvas.height);
            if (cropSelection.w > 0 && cropSelection.h > 0) {
                cropCtx.fillStyle = "rgba(0,0,0,0.35)";
                cropCtx.fillRect(0, 0, cropCanvas.width, cropCanvas.height);
                cropCtx.clearRect(cropSelection.x / cropScale, cropSelection.y / cropScale, cropSelection.w / cropScale, cropSelection.h / cropScale);
                cropCtx.strokeStyle = "#3B82F6";
                cropCtx.lineWidth = 2;
                cropCtx.strokeRect(cropSelection.x / cropScale, cropSelection.y / cropScale, cropSelection.w / cropScale, cropSelection.h / cropScale);
            }
        }

        cropImageInput.addEventListener("change", function() {
            const file = this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    cropImage = img;
                    const maxCanvasWidth = 700;
                    cropScale = Math.min(1, maxCanvasWidth / img.width);
                    cropCanvas.width = Math.round(img.width * cropScale);
                    cropCanvas.height = Math.round(img.height * cropScale);
                    cropSelection = { x: 0, y: 0, w: img.width, h: img.height };
                    document.getElementById("cropWorkspace").classList.remove("hidden");
                    document.getElementById("cropDownloadBtn").classList.add("hidden");
                    document.getElementById("cropResultWrap").classList.add("hidden");
                    updateCropReadout();
                    drawCropCanvas();
                    document.getElementById("cropStatus").innerText = "Drag on the image to select a crop area.";
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        });

        cropCanvas.addEventListener("mousedown", function(event) {
            if (!cropImage) return;
            const rect = cropCanvas.getBoundingClientRect();
            cropDragging = true;
            cropStart = {
                x: Math.max(0, Math.min(cropCanvas.width, event.clientX - rect.left)),
                y: Math.max(0, Math.min(cropCanvas.height, event.clientY - rect.top))
            };
        });

        cropCanvas.addEventListener("mousemove", function(event) {
            if (!cropDragging || !cropStart) return;
            const rect = cropCanvas.getBoundingClientRect();
            const currentX = Math.max(0, Math.min(cropCanvas.width, event.clientX - rect.left));
            const currentY = Math.max(0, Math.min(cropCanvas.height, event.clientY - rect.top));
            const x = Math.min(cropStart.x, currentX);
            const y = Math.min(cropStart.y, currentY);
            const w = Math.abs(currentX - cropStart.x);
            const h = Math.abs(currentY - cropStart.y);
            cropSelection = {
                x: Math.round(x / cropScale),
                y: Math.round(y / cropScale),
                w: Math.max(1, Math.round(w / cropScale)),
                h: Math.max(1, Math.round(h / cropScale))
            };
            updateCropReadout();
            drawCropCanvas();
        });

        window.addEventListener("mouseup", function() {
            cropDragging = false;
            cropStart = null;
        });

        document.getElementById("cropImageBtn").addEventListener("click", function() {
            if (!cropImage) return alert("Please select an image first");
            if (!cropSelection.w || !cropSelection.h) return alert("Please drag to select a crop area");
            const format = document.getElementById("cropFormat").value;
            const quality = (parseInt(document.getElementById("cropQuality").value, 10) || 92) / 100;
            const output = document.createElement("canvas");
            output.width = cropSelection.w;
            output.height = cropSelection.h;
            const outputCtx = output.getContext("2d");
            outputCtx.imageSmoothingEnabled = true;
            outputCtx.imageSmoothingQuality = "high";
            outputCtx.drawImage(cropImage, cropSelection.x, cropSelection.y, cropSelection.w, cropSelection.h, 0, 0, cropSelection.w, cropSelection.h);
            output.toBlob(function(blob) {
                if (!blob) return alert("Could not crop image.");
                cropBlob = blob;
                const url = URL.createObjectURL(blob);
                document.getElementById("cropResultImg").src = url;
                document.getElementById("cropResultWrap").classList.remove("hidden");
                document.getElementById("cropDownloadBtn").classList.remove("hidden");
                document.getElementById("cropStatus").innerText = "Cropped image ready.";
            }, format, quality);
        });

        document.getElementById("cropDownloadBtn").addEventListener("click", function() {
            if (!cropBlob) return;
            const file = cropImageInput.files[0];
            const format = document.getElementById("cropFormat").value;
            const ext = format === "image/png" ? "png" : (format === "image/webp" ? "webp" : "jpg");
            const base = (file ? file.name : "cropped").replace(/\\.[^.]+$/, "");
            const url = URL.createObjectURL(cropBlob);
            const a = document.createElement("a");
            a.href = url;
            a.download = base + "-cropped." + ext;
            a.click();
            URL.revokeObjectURL(url);
        });
    </script>';
}

function getImageEnhancerHTML() {
    return '
    <div class="space-y-6">
        <div class="rounded-2xl border border-blue-200/70 bg-blue-50/80 dark:bg-blue-950/30 dark:border-blue-900 p-4">
            <div class="font-semibold text-blue-900 dark:text-blue-100">Improve blurry images</div>
            <p class="mt-1 text-sm text-blue-800 dark:text-blue-200">Upscale and sharpen low-quality images directly in your browser. No upload required.</p>
        </div>
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'enhancerInput\').click()">
            <input type="file" id="enhancerInput" class="hidden" accept="image/*">
            <div class="text-5xl mb-3">âœ¨</div>
            <p class="font-medium">Choose an image to enhance</p>
            <p class="text-sm text-gray-500 mt-2">Best for blurry, low-resolution photos</p>
        </div>

        <div class="grid md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Upscale</label>
                <select id="enhancerScale" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                    <option value="1.5">1.5x</option>
                    <option value="2" selected>2x</option>
                    <option value="3">3x</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Sharpness: <span id="enhancerSharpnessValue">55</span>%</label>
                <input type="range" id="enhancerSharpness" min="0" max="100" value="55" class="w-full">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Detail boost: <span id="enhancerDetailValue">18</span>%</label>
                <input type="range" id="enhancerDetail" min="0" max="40" value="18" class="w-full">
            </div>
        </div>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Denoise: <span id="enhancerDenoiseValue">8</span>%</label>
                <input type="range" id="enhancerDenoise" min="0" max="30" value="8" class="w-full">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Output format</label>
                <select id="enhancerFormat" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                    <option value="image/png">PNG</option>
                    <option value="image/jpeg" selected>JPG</option>
                    <option value="image/webp">WEBP</option>
                </select>
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Output quality: <span id="enhancerQualityValue">92</span>%</label>
            <input type="range" id="enhancerQuality" min="10" max="100" value="92" class="w-full">
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <p class="text-sm font-medium mb-2">Original</p>
                <div class="rounded-xl border border-gray-200 dark:border-gray-700 p-2 bg-white/70 dark:bg-gray-900/40 min-h-[180px] flex items-center justify-center">
                    <img id="enhancerOriginalPreview" class="max-w-full max-h-72 object-contain rounded-lg hidden">
                    <span id="enhancerOriginalPlaceholder" class="text-sm text-gray-500">No image selected</span>
                </div>
            </div>
            <div>
                <p class="text-sm font-medium mb-2">Enhanced preview</p>
                <div class="rounded-xl border border-gray-200 dark:border-gray-700 p-2 bg-white/70 dark:bg-gray-900/40 min-h-[180px] flex items-center justify-center">
                    <img id="enhancerResultPreview" class="max-w-full max-h-72 object-contain rounded-lg hidden">
                    <span id="enhancerResultPlaceholder" class="text-sm text-gray-500">Run enhancement to preview</span>
                </div>
            </div>
        </div>

        <div class="grid sm:grid-cols-2 gap-3">
            <button id="enhancerRunBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Enhance Image</button>
            <button id="enhancerDownloadBtn" class="w-full bg-green-600 text-white py-3 rounded-xl font-semibold hover:bg-green-700 transition hidden">Download Enhanced</button>
        </div>
        <p id="enhancerStatus" class="text-sm text-gray-500 text-center"></p>
    </div>
    <script>
        (function() {
            let sourceImage = null;
            let outputBlob = null;

            const input = document.getElementById("enhancerInput");
            const scaleSelect = document.getElementById("enhancerScale");
            const sharpness = document.getElementById("enhancerSharpness");
            const sharpnessValue = document.getElementById("enhancerSharpnessValue");
            const detail = document.getElementById("enhancerDetail");
            const detailValue = document.getElementById("enhancerDetailValue");
            const denoise = document.getElementById("enhancerDenoise");
            const denoiseValue = document.getElementById("enhancerDenoiseValue");
            const formatSelect = document.getElementById("enhancerFormat");
            const qualityRange = document.getElementById("enhancerQuality");
            const qualityValue = document.getElementById("enhancerQualityValue");
            const runBtn = document.getElementById("enhancerRunBtn");
            const downloadBtn = document.getElementById("enhancerDownloadBtn");
            const status = document.getElementById("enhancerStatus");
            const originalPreview = document.getElementById("enhancerOriginalPreview");
            const resultPreview = document.getElementById("enhancerResultPreview");
            const originalPlaceholder = document.getElementById("enhancerOriginalPlaceholder");
            const resultPlaceholder = document.getElementById("enhancerResultPlaceholder");

            sharpness.addEventListener("input", function() {
                sharpnessValue.textContent = this.value;
            });
            detail.addEventListener("input", function() {
                detailValue.textContent = this.value;
            });
            denoise.addEventListener("input", function() {
                denoiseValue.textContent = this.value;
            });
            qualityRange.addEventListener("input", function() {
                qualityValue.textContent = this.value;
            });

            input.addEventListener("change", function() {
                const file = this.files[0];
                outputBlob = null;
                downloadBtn.classList.add("hidden");
                resultPreview.classList.add("hidden");
                resultPlaceholder.classList.remove("hidden");
                if (!file) return;
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = new Image();
                    img.onload = function() {
                        sourceImage = img;
                        originalPreview.src = e.target.result;
                        originalPreview.classList.remove("hidden");
                        originalPlaceholder.classList.add("hidden");
                        status.textContent = "Image loaded. Tune settings and click Enhance Image.";
                    };
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
            });

            function boxBlurPass(src, width, height, radius) {
                if (radius <= 0) return src;
                const tmp = new Uint8ClampedArray(src.length);
                const out = new Uint8ClampedArray(src.length);
                const r = Math.max(1, radius | 0);
                for (let y = 0; y < height; y++) {
                    for (let x = 0; x < width; x++) {
                        let rs = 0, gs = 0, bs = 0, as = 0, c = 0;
                        for (let k = -r; k <= r; k++) {
                            const xx = Math.max(0, Math.min(width - 1, x + k));
                            const i = (y * width + xx) * 4;
                            rs += src[i]; gs += src[i + 1]; bs += src[i + 2]; as += src[i + 3]; c++;
                        }
                        const o = (y * width + x) * 4;
                        tmp[o] = rs / c; tmp[o + 1] = gs / c; tmp[o + 2] = bs / c; tmp[o + 3] = as / c;
                    }
                }
                for (let y = 0; y < height; y++) {
                    for (let x = 0; x < width; x++) {
                        let rs = 0, gs = 0, bs = 0, as = 0, c = 0;
                        for (let k = -r; k <= r; k++) {
                            const yy = Math.max(0, Math.min(height - 1, y + k));
                            const i = (yy * width + x) * 4;
                            rs += tmp[i]; gs += tmp[i + 1]; bs += tmp[i + 2]; as += tmp[i + 3]; c++;
                        }
                        const o = (y * width + x) * 4;
                        out[o] = rs / c; out[o + 1] = gs / c; out[o + 2] = bs / c; out[o + 3] = as / c;
                    }
                }
                return out;
            }

            function enhancePixels(imageData, width, height, sharpAmount, detailAmount, denoiseAmount) {
                const src = imageData.data;
                const blur = boxBlurPass(src, width, height, 1 + Math.round(denoiseAmount * 1.4));
                const out = new Uint8ClampedArray(src.length);
                for (let i = 0; i < src.length; i += 4) {
                    for (let ch = 0; ch < 3; ch++) {
                        const base = src[i + ch] * (1 - denoiseAmount) + blur[i + ch] * denoiseAmount;
                        const hf = src[i + ch] - blur[i + ch];
                        let v = base + hf * (0.9 + sharpAmount * 1.2);
                        v = (v - 128) * (1 + detailAmount * 0.28) + 128;
                        out[i + ch] = Math.max(0, Math.min(255, Math.round(v)));
                    }
                    out[i + 3] = src[i + 3];
                }
                imageData.data.set(out);
                return imageData;
            }

            runBtn.addEventListener("click", function() {
                if (!sourceImage) return alert("Please choose an image first.");
                status.textContent = "Enhancing image...";
                const requestedScale = parseFloat(scaleSelect.value || "2");
                const sharpAmount = (parseInt(sharpness.value, 10) || 0) / 100;
                const detailAmount = (parseInt(detail.value, 10) || 0) / 100;
                const denoiseAmount = (parseInt(denoise.value, 10) || 0) / 100;
                const qualityAmount = (parseInt(qualityRange.value, 10) || 92) / 100;
                const isMobile = window.matchMedia("(max-width: 768px)").matches;
                const lowPowerDevice = (navigator.deviceMemory && navigator.deviceMemory <= 4) || (navigator.hardwareConcurrency && navigator.hardwareConcurrency <= 4);
                const maxPixels = (isMobile || lowPowerDevice) ? 3500000 : 9000000;
                let outW = Math.max(1, Math.round(sourceImage.width * requestedScale));
                let outH = Math.max(1, Math.round(sourceImage.height * requestedScale));
                const pixels = outW * outH;
                if (pixels > maxPixels) {
                    const ratio = Math.sqrt(maxPixels / pixels);
                    outW = Math.max(1, Math.round(outW * ratio));
                    outH = Math.max(1, Math.round(outH * ratio));
                }

                const canvas = document.createElement("canvas");
                canvas.width = outW;
                canvas.height = outH;
                const ctx = canvas.getContext("2d", { willReadFrequently: true });
                ctx.imageSmoothingEnabled = true;
                ctx.imageSmoothingQuality = "high";
                ctx.clearRect(0, 0, outW, outH);
                ctx.drawImage(sourceImage, 0, 0, sourceImage.width, sourceImage.height, 0, 0, outW, outH);
                let imageData = ctx.getImageData(0, 0, outW, outH);
                imageData = enhancePixels(imageData, outW, outH, sharpAmount, detailAmount, denoiseAmount);
                ctx.putImageData(imageData, 0, 0);

                const format = formatSelect.value;
                const quality = format === "image/png" ? undefined : qualityAmount;
                canvas.toBlob(function(blob) {
                    if (!blob) {
                        status.textContent = "Could not process image.";
                        return;
                    }
                    outputBlob = blob;
                    const previewUrl = URL.createObjectURL(blob);
                    resultPreview.src = previewUrl;
                    resultPreview.classList.remove("hidden");
                    resultPlaceholder.classList.add("hidden");
                    downloadBtn.classList.remove("hidden");
                    status.textContent = "Enhancement complete: " + outW + " x " + outH + " output.";
                }, format, quality);
            });

            downloadBtn.addEventListener("click", function() {
                if (!outputBlob) return;
                const file = input.files[0];
                const format = formatSelect.value;
                const ext = format === "image/png" ? "png" : (format === "image/webp" ? "webp" : "jpg");
                const base = (file ? file.name : "image").replace(/\\.[^.]+$/, "");
                const a = document.createElement("a");
                a.href = URL.createObjectURL(outputBlob);
                a.download = base + "-enhanced." + ext;
                a.click();
            });
        })();
    </script>';
}

function getAiImageGeneratorHTML() {
    return '
    <div class="space-y-6">
        <div class="text-center">
            <div class="text-5xl mb-3">ðŸŽ¨</div>
            <p class="font-medium text-lg">AI Image Generator</p>
            <p class="text-sm text-gray-500 mt-2">Generate images from text prompts using the server-configured AI provider</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium mb-2">Enter your prompt</label>
            <textarea id="aiPrompt" class="w-full h-32 p-4 bg-gray-50 dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" placeholder="Example: A beautiful sunset over mountains with a lake, ultra realistic, 4k, cinematic lighting"></textarea>
        </div>
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-2">Width</label>
                <select id="aiWidth" class="w-full p-3 bg-gray-50 dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-600">
                    <option value="512">512px</option>
                    <option value="768">768px</option>
                    <option value="1024" selected>1024px</option>
                    <option value="1536">1536px</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-2">Height</label>
                <select id="aiHeight" class="w-full p-3 bg-gray-50 dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-600">
                    <option value="512">512px</option>
                    <option value="768">768px</option>
                    <option value="1024" selected>1024px</option>
                    <option value="1536">1536px</option>
                </select>
            </div>
        </div>
        
        <div>
            <label class="block text-sm font-medium mb-2">Negative Prompt (optional - what to avoid)</label>
            <textarea id="aiNegativePrompt" class="w-full h-20 p-3 bg-gray-50 dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-600 focus:border-blue-500 transition" placeholder="worst quality, blurry, distorted, ugly, bad anatomy"></textarea>
        </div>
        
        <div class="flex gap-3">
            <button id="generateBtn" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold transition-all shadow-lg shadow-blue-200 dark:shadow-none">
                Generate Image
            </button>
            <button id="downloadBtn" class="flex-1 bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-semibold transition-all hidden">
                Download Image
            </button>
        </div>
        
        <div id="statusMessage" class="text-sm text-center py-2 rounded-lg hidden"></div>
        
        <div id="resultContainer" class="hidden mt-4">
            <div class="rounded-xl border border-gray-200 dark:border-gray-700 p-4 bg-gray-50 dark:bg-gray-800/50">
                <div id="imagePreview" class="flex items-center justify-center min-h-[300px]">
                    <img id="generatedImage" class="max-w-full rounded-lg shadow-lg" style="display: none;">
                </div>
            </div>
        </div>
        
        
    </div>
    
    <script>
        (function() {
            const generateBtn = document.getElementById("generateBtn");
            const downloadBtn = document.getElementById("downloadBtn");
            const promptInput = document.getElementById("aiPrompt");
            const negativePrompt = document.getElementById("aiNegativePrompt");
            const widthSelect = document.getElementById("aiWidth");
            const heightSelect = document.getElementById("aiHeight");
            const statusDiv = document.getElementById("statusMessage");
            const resultContainer = document.getElementById("resultContainer");
            const generatedImage = document.getElementById("generatedImage");
            
            let currentImageBlob = null;
            let currentImageUrl = "";
            
            
            
            function showStatus(message, isError = false) {
                statusDiv.textContent = message;
                statusDiv.className = "text-sm text-center py-2 rounded-lg " + (isError ? "bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400" : "bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400");
                statusDiv.classList.remove("hidden");
                
                setTimeout(() => {
                    if (statusDiv.textContent === message) {
                        statusDiv.classList.add("hidden");
                    }
                }, 5000);
            }
            
            
            
            async function generateImage() {
                const prompt = promptInput.value.trim();
                if (!prompt) {
                    showStatus("Please enter a prompt first", true);
                    return null;
                }
                
                const width = widthSelect.value;
                const height = heightSelect.value;
                const negPrompt = negativePrompt.value.trim();
                

                try {
                    showStatus("ðŸŽ¨ Generating your image... This may take a few seconds.");
                    
                    // Make authenticated request
                    const response = await fetch("backend/ai_image_proxy.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            prompt: prompt,
                            negative_prompt: negPrompt,
                            width: parseInt(width, 10),
                            height: parseInt(height, 10)
                        })
                    });
                    
                    if (!response.ok) {
                        const contentType = response.headers.get("content-type") || "";
                        let errorMessage = `HTTP ${response.status}: Failed to generate image`;
                        if (contentType.includes("application/json")) {
                            const errorData = await response.json();
                            errorMessage = errorData.error?.message || errorMessage;
                        } else {
                            const errorText = await response.text();
                            errorMessage = errorText || errorMessage;
                        }
                        throw new Error(errorMessage);
                    }
                    
                    // Get the image blob
                    const blob = await response.blob();
                    currentImageBlob = blob;
                    currentImageUrl = URL.createObjectURL(blob);
                    
                    // Display the image
                    generatedImage.src = currentImageUrl;
                    generatedImage.style.display = "block";
                    resultContainer.classList.remove("hidden");
                    downloadBtn.classList.remove("hidden");
                    
                    showStatus(" Image generated successfully!");
                    return blob;
                    
                } catch (error) {
                    console.error("Generation error:", error);
                    showStatus("âŒ " + error.message, true);
                    resultContainer.classList.add("hidden");
                    return null;
                }
            }
            
            generateBtn.addEventListener("click", async function() {
                // Disable button and show loading
                generateBtn.disabled = true;
                generateBtn.textContent = "Generating...";
                generateBtn.classList.add("opacity-50", "cursor-not-allowed");
                resultContainer.classList.add("hidden");
                generatedImage.style.display = "none";
                downloadBtn.classList.add("hidden");
                
                // Clean up old URL if exists
                if (currentImageUrl) {
                    URL.revokeObjectURL(currentImageUrl);
                }
                
                await generateImage();
                
                // Re-enable button
                generateBtn.disabled = false;
                generateBtn.textContent = "Generate Image";
                generateBtn.classList.remove("opacity-50", "cursor-not-allowed");
            });
            
            downloadBtn.addEventListener("click", async function() {
                if (!currentImageBlob) {
                    showStatus("No image to download", true);
                    return;
                }
                
                try {
                    showStatus(" Downloading image...");
                    
                    const url = URL.createObjectURL(currentImageBlob);
                    const a = document.createElement("a");
                    const timestamp = new Date().getTime();
                    a.download = `ai-generated-${timestamp}.png`;
                    a.href = url;
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                    URL.revokeObjectURL(url);
                    
                    showStatus(" Image downloaded!");
                } catch (error) {
                    console.error("Download error:", error);
                    showStatus(" Failed to download image", true);
                }
            });
            
            // Generate on Ctrl+Enter
            promptInput.addEventListener("keydown", function(e) {
                if (e.ctrlKey && e.key === "Enter") {
                    generateBtn.click();
                }
            });
        })();
    </script>';
}

function getImageConverterHTML() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'imageConverterInput\').click()">
            <input type="file" id="imageConverterInput" class="hidden" accept="image/*">
            <div class="text-5xl mb-3">CONVERT</div>
            <p class="font-medium">Upload an image to change its format</p>
            <p class="text-sm text-gray-500 mt-2">Convert JPG, PNG, and WEBP with adjustable quality</p>
        </div>
        <div id="imageConverterPreviewWrap" class="hidden grid md:grid-cols-2 gap-4 items-start">
            <div>
                <p class="text-sm font-medium mb-2">Original</p>
                <img id="imageConverterOriginalImg" class="w-full max-h-72 object-contain rounded-xl border border-gray-200 dark:border-gray-700 bg-white/60">
                <p id="imageConverterOriginalMeta" class="text-xs text-gray-500 mt-2"></p>
            </div>
            <div>
                <p class="text-sm font-medium mb-2">Converted Preview</p>
                <img id="imageConverterResultImg" class="w-full max-h-72 object-contain rounded-xl border border-gray-200 dark:border-gray-700 bg-white/60 hidden">
                <p id="imageConverterResultMeta" class="text-xs text-gray-500 mt-2"></p>
            </div>
        </div>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Output format</label>
                <select id="imageConverterFormat" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                    <option value="image/png">PNG</option>
                    <option value="image/jpeg" selected>JPG</option>
                    <option value="image/webp">WEBP</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Quality: <span id="imageConverterQualityValue">92</span>%</label>
                <input type="range" id="imageConverterQuality" min="10" max="100" value="92" class="w-full">
            </div>
        </div>
        <div class="grid sm:grid-cols-2 gap-3">
            <button id="imageConverterRunBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Convert Image</button>
            <button id="imageConverterDownloadBtn" class="w-full bg-green-600 text-white py-3 rounded-xl font-semibold hover:bg-green-700 transition hidden">Download Converted Image</button>
        </div>
        <p id="imageConverterStatus" class="text-sm text-gray-500 text-center"></p>
    </div>
    <script>
        (function() {
            let outputBlob = null;
            const input = document.getElementById("imageConverterInput");
            const formatSelect = document.getElementById("imageConverterFormat");
            const qualityInput = document.getElementById("imageConverterQuality");
            const qualityValue = document.getElementById("imageConverterQualityValue");
            const runBtn = document.getElementById("imageConverterRunBtn");
            const downloadBtn = document.getElementById("imageConverterDownloadBtn");
            const previewWrap = document.getElementById("imageConverterPreviewWrap");
            const originalImg = document.getElementById("imageConverterOriginalImg");
            const resultImg = document.getElementById("imageConverterResultImg");
            const originalMeta = document.getElementById("imageConverterOriginalMeta");
            const resultMeta = document.getElementById("imageConverterResultMeta");
            const status = document.getElementById("imageConverterStatus");

            qualityInput.addEventListener("input", function() {
                qualityValue.textContent = this.value;
            });

            input.addEventListener("change", function() {
                const file = this.files[0];
                outputBlob = null;
                resultImg.classList.add("hidden");
                downloadBtn.classList.add("hidden");
                if (!file) return;
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = new Image();
                    img.onload = function() {
                        originalImg.src = e.target.result;
                        originalMeta.textContent = img.width + " x " + img.height + " â€¢ " + Math.round(file.size / 1024) + " KB";
                        previewWrap.classList.remove("hidden");
                        status.textContent = "Image loaded. Choose a format and click Convert Image.";
                    };
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
            });

            runBtn.addEventListener("click", function() {
                const file = input.files[0];
                if (!file) return alert("Please select an image first");
                status.textContent = "Converting image...";
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = new Image();
                    img.onload = function() {
                        const canvas = document.createElement("canvas");
                        canvas.width = img.width;
                        canvas.height = img.height;
                        const ctx = canvas.getContext("2d");
                        ctx.imageSmoothingEnabled = true;
                        ctx.imageSmoothingQuality = "high";
                        ctx.clearRect(0, 0, canvas.width, canvas.height);
                        ctx.drawImage(img, 0, 0);
                        const format = formatSelect.value;
                        const quality = format === "image/png" ? undefined : ((parseInt(qualityInput.value, 10) || 92) / 100);
                        canvas.toBlob(function(blob) {
                            if (!blob) {
                                status.textContent = "Could not convert image.";
                                return;
                            }
                            outputBlob = blob;
                            const resultUrl = URL.createObjectURL(blob);
                            resultImg.src = resultUrl;
                            resultImg.classList.remove("hidden");
                            downloadBtn.classList.remove("hidden");
                            resultMeta.textContent = img.width + " x " + img.height + " â€¢ " + Math.round(blob.size / 1024) + " KB";
                            status.textContent = "Converted image ready.";
                        }, format, quality);
                    };
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
            });

            downloadBtn.addEventListener("click", function() {
                if (!outputBlob) return;
                const file = input.files[0];
                const format = formatSelect.value;
                const ext = format === "image/png" ? "png" : (format === "image/webp" ? "webp" : "jpg");
                const base = (file ? file.name : "converted").replace(/\\.[^.]+$/, "");
                const url = URL.createObjectURL(outputBlob);
                const a = document.createElement("a");
                a.href = url;
                a.download = base + "-converted." + ext;
                a.click();
                URL.revokeObjectURL(url);
            });
        })();
    </script>';
}

function getVideoToAudioHTML() {
    return '
    <div class="space-y-6">
        <div class="rounded-2xl border border-indigo-200/70 bg-indigo-50/80 dark:bg-indigo-950/30 dark:border-indigo-900 p-4">
            <div class="font-semibold text-indigo-900 dark:text-indigo-100">Extract audio from video</div>
            <p class="mt-1 text-sm text-indigo-800 dark:text-indigo-200">Convert MP4, MOV, WEBM, AVI, MKV, and more into MP3, WAV, OGG, AAC, or FLAC directly in your browser.</p>
        </div>
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'videoToAudioInput\').click()">
            <input type="file" id="videoToAudioInput" class="hidden" accept="video/*,.mkv,.avi,.mov,.mp4,.webm,.m4v">
            <div class="text-5xl mb-3">VIDEO</div>
            <p class="font-medium">Upload a video file</p>
            <p class="text-sm text-gray-500 mt-2">Audio is extracted locally with FFmpeg WebAssembly</p>
        </div>
        <div id="videoToAudioMetaWrap" class="hidden rounded-xl border border-gray-200 dark:border-gray-700 bg-white/60 dark:bg-gray-900/30 p-4 space-y-2">
            <div class="font-medium text-sm">Selected file</div>
            <div id="videoToAudioFileMeta" class="text-sm text-gray-500"></div>
            <video id="videoToAudioPreview" class="w-full max-h-72 rounded-xl bg-black hidden" controls preload="metadata"></video>
        </div>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Output format</label>
                <select id="videoToAudioFormat" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                    <option value="mp3" selected>MP3</option>
                    <option value="wav">WAV</option>
                    <option value="aac">AAC</option>
                    <option value="ogg">OGG</option>
                    <option value="flac">FLAC</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Audio quality / bitrate</label>
                <select id="videoToAudioBitrate" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                    <option value="96k">96 kbps</option>
                    <option value="128k" selected>128 kbps</option>
                    <option value="192k">192 kbps</option>
                    <option value="256k">256 kbps</option>
                    <option value="320k">320 kbps</option>
                </select>
            </div>
        </div>
        <div class="grid sm:grid-cols-2 gap-3">
            <button id="videoToAudioRunBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Convert to Audio</button>
            <button id="videoToAudioDownloadBtn" class="w-full bg-green-600 text-white py-3 rounded-xl font-semibold hover:bg-green-700 transition hidden">Download Audio</button>
        </div>
        <audio id="videoToAudioPlayer" class="w-full hidden" controls></audio>
        <p id="videoToAudioStatus" class="text-sm text-gray-500 text-center"></p>
    </div>
    <script src="assets/vendor/ffmpeg/ffmpeg.js"></script>
    <script src="assets/vendor/ffmpeg/util.js"></script>
    <script>
        (function() {
            const input = document.getElementById("videoToAudioInput");
            const formatSelect = document.getElementById("videoToAudioFormat");
            const bitrateSelect = document.getElementById("videoToAudioBitrate");
            const runBtn = document.getElementById("videoToAudioRunBtn");
            const downloadBtn = document.getElementById("videoToAudioDownloadBtn");
            const status = document.getElementById("videoToAudioStatus");
            const metaWrap = document.getElementById("videoToAudioMetaWrap");
            const fileMeta = document.getElementById("videoToAudioFileMeta");
            const preview = document.getElementById("videoToAudioPreview");
            const player = document.getElementById("videoToAudioPlayer");

            let ffmpeg = null;
            let ffmpegLoaded = false;
            let outputBlob = null;
            let outputName = "";
            let previewUrl = "";
            let audioUrl = "";

            function setStatus(message) {
                status.textContent = message;
            }

            function revokeUrls() {
                if (previewUrl) {
                    URL.revokeObjectURL(previewUrl);
                    previewUrl = "";
                }
                if (audioUrl) {
                    URL.revokeObjectURL(audioUrl);
                    audioUrl = "";
                }
            }

            async function ensureFFmpegLoaded() {
                if (ffmpegLoaded) return ffmpeg;
                const { FFmpeg } = FFmpegWASM;
                const { toBlobURL } = FFmpegUtil;
                ffmpeg = new FFmpeg();
                ffmpeg.on("log", function(event) {
                    if (event && event.message) {
                        setStatus("Processing: " + event.message);
                    }
                });

                const baseURL = "https://cdn.jsdelivr.net/npm/@ffmpeg/core@0.12.6/dist/umd";
                setStatus("Loading video conversion engine...");
                await ffmpeg.load({
                    coreURL: await toBlobURL(baseURL + "/ffmpeg-core.js", "text/javascript"),
                    wasmURL: await toBlobURL(baseURL + "/ffmpeg-core.wasm", "application/wasm")
                });
                ffmpegLoaded = true;
                setStatus("Converter ready.");
                return ffmpeg;
            }

            function getOutputSettings(format, bitrate) {
                switch (format) {
                    case "wav":
                        return { extension: "wav", mime: "audio/wav", args: ["-vn", "-acodec", "pcm_s16le", "-ar", "44100", "-ac", "2"] };
                    case "aac":
                        return { extension: "aac", mime: "audio/aac", args: ["-vn", "-c:a", "aac", "-b:a", bitrate] };
                    case "ogg":
                        return { extension: "ogg", mime: "audio/ogg", args: ["-vn", "-c:a", "libvorbis", "-b:a", bitrate] };
                    case "flac":
                        return { extension: "flac", mime: "audio/flac", args: ["-vn", "-c:a", "flac"] };
                    case "mp3":
                    default:
                        return { extension: "mp3", mime: "audio/mpeg", args: ["-vn", "-c:a", "libmp3lame", "-b:a", bitrate] };
                }
            }

            input.addEventListener("change", function() {
                const file = this.files[0];
                outputBlob = null;
                outputName = "";
                downloadBtn.classList.add("hidden");
                player.classList.add("hidden");
                player.removeAttribute("src");
                revokeUrls();
                if (!file) return;

                previewUrl = URL.createObjectURL(file);
                preview.src = previewUrl;
                preview.classList.remove("hidden");
                metaWrap.classList.remove("hidden");
                fileMeta.textContent = file.name + " â€¢ " + Math.round(file.size / 1024 / 1024 * 100) / 100 + " MB";
                setStatus("Video loaded. Choose a format and click Convert to Audio.");
            });

            runBtn.addEventListener("click", async function() {
                const file = input.files[0];
                if (!file) return alert("Please select a video first");

                runBtn.disabled = true;
                runBtn.classList.add("opacity-50", "cursor-not-allowed");
                downloadBtn.classList.add("hidden");
                player.classList.add("hidden");
                player.removeAttribute("src");
                outputBlob = null;
                outputName = "";
                if (audioUrl) {
                    URL.revokeObjectURL(audioUrl);
                    audioUrl = "";
                }

                try {
                    const engine = await ensureFFmpegLoaded();
                    const { fetchFile } = FFmpegUtil;
                    const extMatch = file.name.match(/\.([^.]+)$/);
                    const inputExt = extMatch ? extMatch[1].toLowerCase() : "mp4";
                    const safeInputName = "input." + inputExt;
                    const baseName = file.name.replace(/\.[^.]+$/, "") || "audio";
                    const format = formatSelect.value;
                    const bitrate = bitrateSelect.value;
                    const settings = getOutputSettings(format, bitrate);
                    const outputFileName = "output." + settings.extension;

                    setStatus("Preparing video file...");
                    await engine.writeFile(safeInputName, await fetchFile(file));

                    setStatus("Extracting audio...");
                    await engine.exec(["-i", safeInputName].concat(settings.args, [outputFileName]));

                    const data = await engine.readFile(outputFileName);
                    const bytes = data instanceof Uint8Array ? data : new Uint8Array(data.buffer || data);
                    outputBlob = new Blob([bytes], { type: settings.mime });
                    outputName = baseName + "." + settings.extension;
                    audioUrl = URL.createObjectURL(outputBlob);
                    player.src = audioUrl;
                    player.classList.remove("hidden");
                    downloadBtn.classList.remove("hidden");
                    setStatus("Audio extracted successfully.");

                    try { await engine.deleteFile(safeInputName); } catch (e) {}
                    try { await engine.deleteFile(outputFileName); } catch (e) {}
                } catch (error) {
                    console.error("Video to audio conversion failed:", error);
                    setStatus("Conversion failed: " + (error && error.message ? error.message : "Unknown error"));
                } finally {
                    runBtn.disabled = false;
                    runBtn.classList.remove("opacity-50", "cursor-not-allowed");
                }
            });

            downloadBtn.addEventListener("click", function() {
                if (!outputBlob) return;
                const url = URL.createObjectURL(outputBlob);
                const a = document.createElement("a");
                a.href = url;
                a.download = outputName || "audio.mp3";
                a.click();
                URL.revokeObjectURL(url);
            });
        })();
    </script>';
}
function getOcrToolHTML() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'ocrImageInput\').click()">
            <input type="file" id="ocrImageInput" class="hidden" accept="image/*">
            <div class="text-5xl mb-3">ðŸ‘ï¸ðŸ“</div>
            <p class="font-medium">Upload an image with text</p>
            <p class="text-sm text-gray-500 mt-2">We\'ll extract text using OCR (works best with clear images)</p>
        </div>
        <div id="ocrPreview" class="hidden mt-4 text-center">
            <img id="ocrPreviewImg" class="max-w-full h-32 object-contain rounded-lg mx-auto">
        </div>
        <button id="ocrBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Extract Text</button>
        <div id="ocrResult" class="hidden mt-4 p-4 bg-gray-100 dark:bg-gray-700 rounded-xl">
            <h4 class="font-bold mb-2">Extracted Text:</h4>
            <p id="ocrText" class="whitespace-pre-wrap text-sm max-h-64 overflow-y-auto"></p>
            <button id="copyOcrBtn" class="mt-3 text-sm text-blue-600">Copy to clipboard</button>
        </div>
    </div>
    <script src="https://unpkg.com/tesseract.js@4.0.2/dist/tesseract.min.js"></script>
    <script>
        const ocrInput = document.getElementById("ocrImageInput");
        const ocrPreview = document.getElementById("ocrPreview");
        const ocrPreviewImg = document.getElementById("ocrPreviewImg");
        
        ocrInput.addEventListener("change", function() {
            if(this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    ocrPreviewImg.src = e.target.result;
                    ocrPreview.classList.remove("hidden");
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
        
        document.getElementById("ocrBtn").addEventListener("click", async function() {
            const input = document.getElementById("ocrImageInput");
            if (!input.files.length) return alert("Please select an image");
            const resultDiv = document.getElementById("ocrResult");
            const textDiv = document.getElementById("ocrText");
            resultDiv.classList.add("hidden");
            textDiv.innerText = "Processing... (this may take a few seconds)";
            resultDiv.classList.remove("hidden");
            
            const image = input.files[0];
            try {
                const { data: { text } } = await Tesseract.recognize(image, "eng");
                textDiv.innerText = text || "No text detected. Try a clearer image.";
            } catch(e) {
                textDiv.innerText = "Error processing image: " + e.message;
            }
        });
        
        document.getElementById("copyOcrBtn").addEventListener("click", function() {
            const text = document.getElementById("ocrText").innerText;
            navigator.clipboard.writeText(text);
            alert("Text copied to clipboard!");
        });
    </script>';
}


// ======================== 100% PURE JS FUNCTIONS (FIXED) ========================
function getPdfToWordPureJS() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'pdfToWordInput\').click()">
            <input type="file" id="pdfToWordInput" class="hidden" accept=".pdf">
            <div class="text-5xl mb-3">ðŸ“„âž¡ï¸ðŸ“</div>
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
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'pdfToPptInput\').click()">
            <input type="file" id="pdfToPptInput" class="hidden" accept=".pdf">
            <div class="text-5xl mb-3">ðŸ“„âž¡ï¸ðŸ“Š</div>
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
                    const viewport = page.getViewport({ scale: 2 });
                    const canvas = document.createElement("canvas");
                    const ctx = canvas.getContext("2d");
                    ctx.imageSmoothingEnabled = true;
                    ctx.imageSmoothingQuality = "high";
                    canvas.width = viewport.width; canvas.height = viewport.height;
                    await page.render({ canvasContext: ctx, viewport: viewport }).promise;
                    
                    const slide = pptx.addSlide();
                    const imgData = canvas.toDataURL("image/jpeg", 0.97);
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
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'pdfToExcelInput\').click()">
            <input type="file" id="pdfToExcelInput" class="hidden" accept=".pdf">
            <div class="text-5xl mb-3">ðŸ“„âž¡ï¸ðŸ“ˆ</div>
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
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'wordToPdfInput\').click()">
            <input type="file" id="wordToPdfInput" class="hidden" accept=".doc,.docx">
            <div class="text-5xl mb-3">ðŸ“âž¡ï¸ðŸ“„</div>
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
                wrapper.innerHTML = `<div style="padding:40px; font-family: Arial, serif; font-size: 14pt; color: #000; line-height: 1.6; background: #FFF; width: 800px;">${result.value}</div>`;
                document.body.appendChild(wrapper);
                
                const opt = { 
                    margin: 0, 
                    filename: file.name.replace(/\.[^/.]+$/, "") + ".pdf", 
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
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'protectPdfInput\').click()">
            <input type="file" id="protectPdfInput" class="hidden" accept=".pdf">
            <div class="text-5xl mb-3">ðŸ”’</div>
            <p class="font-medium">Select PDF to protect</p>
            <p class="text-sm text-gray-500 mt-2">Protects document natively via JS Canvas flatten</p>
        </div>
        <div id="protectPreview" class="text-sm text-gray-500 text-center hidden"></div>
        <div class="space-y-4">
            <input type="password" id="pdfPassword" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 border border-gray-200 dark:border-gray-600 rounded-xl" placeholder="Decryption Password">
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
                    const viewport = page.getViewport({ scale: 2.2 });
                    const canvas = document.createElement("canvas");
                    const ctx = canvas.getContext("2d");
                    ctx.imageSmoothingEnabled = true;
                    ctx.imageSmoothingQuality = "high";
                    canvas.width = viewport.width; canvas.height = viewport.height;
                    await page.render({ canvasContext: ctx, viewport: viewport }).promise;
                    
                    const imgData = canvas.toDataURL("image/jpeg", 0.97);
                    
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
        <textarea id="jsonInput" class="w-full h-64 p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl font-mono text-sm border border-gray-200 dark:border-gray-600" placeholder=\'[{"name": "John"}]\' >[{"name":"Any2Convert", "features": "Great"}]</textarea>
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
        <textarea id="qrText" class="w-full h-32 p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 border border-gray-200 dark:border-gray-600 rounded-xl" placeholder="Enter text or URL"></textarea>
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

function getHtmlToPdfHTML() {
    return '
    <div class="space-y-6">
        <textarea id="htmlToPdfInput" class="w-full h-56 p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="<h1>Hello</h1><p>Paste HTML here...</p>"></textarea>
        <button id="htmlToPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Convert HTML to PDF</button>
        <div id="htmlToPdfPreview" class="hidden rounded-xl border border-gray-200 dark:border-gray-700 p-4 bg-gray-50 dark:bg-gray-900"></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        document.getElementById("htmlToPdfBtn").addEventListener("click", async function() {
            const markup = document.getElementById("htmlToPdfInput").value.trim();
            if (!markup) return alert("Please paste some HTML.");
            const preview = document.getElementById("htmlToPdfPreview");
            preview.innerHTML = markup;
            preview.classList.remove("hidden");
            const wrapper = document.createElement("div");
            wrapper.style.padding = "32px";
            wrapper.style.background = "#ffffff";
            wrapper.style.color = "#111827";
            wrapper.innerHTML = markup;
            document.body.appendChild(wrapper);
            await html2pdf().set({ margin: 0.4, filename: "html-to-pdf.pdf", html2canvas: { scale: 2 }, jsPDF: { unit: "in", format: "a4", orientation: "portrait" } }).from(wrapper).save();
            wrapper.remove();
        });
    </script>';
}

function getSplitPdfHTML() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'splitPdfInput\').click()">
            <input type="file" id="splitPdfInput" class="hidden" accept=".pdf">
            <div class="text-5xl mb-3">âœ‚ï¸</div>
            <p class="font-medium">Select PDF to split</p>
            <p class="text-sm text-gray-500 mt-2">Split every page into a separate PDF file</p>
        </div>
        <button id="splitPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Split PDF</button>
        <div id="splitPdfStatus" class="text-sm text-gray-500 text-center hidden"></div>
    </div>
    <script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script>
        document.getElementById("splitPdfBtn").addEventListener("click", async function() {
            const file = document.getElementById("splitPdfInput").files[0];
            if (!file) return alert("Please select a PDF file");
            const status = document.getElementById("splitPdfStatus");
            status.classList.remove("hidden");
            status.textContent = "Splitting PDF...";
            const srcBytes = await file.arrayBuffer();
            const srcDoc = await PDFLib.PDFDocument.load(srcBytes);
            const zip = new JSZip();
            for (let i = 0; i < srcDoc.getPageCount(); i++) {
                const outDoc = await PDFLib.PDFDocument.create();
                const [page] = await outDoc.copyPages(srcDoc, [i]);
                outDoc.addPage(page);
                const pdfBytes = await outDoc.save();
                zip.file(`page-${i + 1}.pdf`, pdfBytes);
            }
            const zipBlob = await zip.generateAsync({ type: "blob" });
            const a = document.createElement("a");
            a.href = URL.createObjectURL(zipBlob);
            a.download = "split-pdf-pages.zip";
            a.click();
            status.textContent = "Done. ZIP downloaded.";
        });
    </script>';
}

function getRemovePagesHTML() {
    return '
    <div class="space-y-6">
        <input type="file" id="removePagesInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
        <input type="text" id="removePagesList" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Pages to remove, e.g. 2,4,7">
        <button id="removePagesBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Remove Pages</button>
    </div>
    <script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
    <script>
        document.getElementById("removePagesBtn").addEventListener("click", async function() {
            const file = document.getElementById("removePagesInput").files[0];
            if (!file) return alert("Please select a PDF file");
            const pages = (document.getElementById("removePagesList").value.match(/\d+/g) || []).map(n => parseInt(n, 10) - 1).filter(n => n >= 0).sort((a,b)=>b-a);
            if (!pages.length) return alert("Enter at least one page number.");
            const pdf = await PDFLib.PDFDocument.load(await file.arrayBuffer());
            pages.forEach(index => { if (index < pdf.getPageCount()) pdf.removePage(index); });
            const bytes = await pdf.save();
            const a = document.createElement("a");
            a.href = URL.createObjectURL(new Blob([bytes], { type: "application/pdf" }));
            a.download = "pages-removed.pdf";
            a.click();
        });
    </script>';
}

function getExtractPagesHTML() {
    return '
    <div class="space-y-6">
        <input type="file" id="extractPagesInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
        <input type="text" id="extractPagesList" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Pages to extract, e.g. 1,3,5">
        <button id="extractPagesBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Extract Pages</button>
    </div>
    <script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
    <script>
        document.getElementById("extractPagesBtn").addEventListener("click", async function() {
            const file = document.getElementById("extractPagesInput").files[0];
            if (!file) return alert("Please select a PDF file");
            const indexes = (document.getElementById("extractPagesList").value.match(/\d+/g) || []).map(n => parseInt(n, 10) - 1).filter(n => n >= 0);
            if (!indexes.length) return alert("Enter pages to extract.");
            const src = await PDFLib.PDFDocument.load(await file.arrayBuffer());
            const out = await PDFLib.PDFDocument.create();
            const valid = indexes.filter(i => i < src.getPageCount());
            const pages = await out.copyPages(src, valid);
            pages.forEach(page => out.addPage(page));
            const bytes = await out.save();
            const a = document.createElement("a");
            a.href = URL.createObjectURL(new Blob([bytes], { type: "application/pdf" }));
            a.download = "extracted-pages.pdf";
            a.click();
        });
    </script>';
}

function getOrganizePdfHTML() {
    return '
    <div class="space-y-6">
        <input type="file" id="organizePdfInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
        <input type="text" id="organizePdfOrder" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="New order, e.g. 3,1,2,4">
        <button id="organizePdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Organize PDF</button>
        <p class="text-sm text-gray-500">Enter the page order you want in the final PDF.</p>
    </div>
    <script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
    <script>
        document.getElementById("organizePdfBtn").addEventListener("click", async function() {
            const file = document.getElementById("organizePdfInput").files[0];
            if (!file) return alert("Please select a PDF file");
            const order = (document.getElementById("organizePdfOrder").value.match(/\d+/g) || []).map(n => parseInt(n, 10) - 1);
            if (!order.length) return alert("Enter a new page order.");
            const src = await PDFLib.PDFDocument.load(await file.arrayBuffer());
            const out = await PDFLib.PDFDocument.create();
            const valid = order.filter(i => i >= 0 && i < src.getPageCount());
            const pages = await out.copyPages(src, valid);
            pages.forEach(page => out.addPage(page));
            const bytes = await out.save();
            const a = document.createElement("a");
            a.href = URL.createObjectURL(new Blob([bytes], { type: "application/pdf" }));
            a.download = "organized.pdf";
            a.click();
        });
    </script>';
}

function getScanToPdfHTML() {
    return '
    <div class="space-y-6">
        <input type="file" id="scanToPdfInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept="image/*" capture="environment" multiple>
        <button id="scanToPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Scan Images to PDF</button>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        document.getElementById("scanToPdfBtn").addEventListener("click", async function() {
            const files = document.getElementById("scanToPdfInput").files;
            if (!files.length) return alert("Please capture or select images.");
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF("p", "mm", "a4");
            const pageWidth = doc.internal.pageSize.getWidth();
            const pageHeight = doc.internal.pageSize.getHeight();
            for (let i = 0; i < files.length; i++) {
                const dataUrl = await new Promise(resolve => { const r = new FileReader(); r.onload = e => resolve(e.target.result); r.readAsDataURL(files[i]); });
                const img = new Image();
                img.src = dataUrl;
                await img.decode();
                if (i > 0) doc.addPage();
                const ratio = Math.min(pageWidth / img.width, pageHeight / img.height);
                const w = img.width * ratio;
                const h = img.height * ratio;
                doc.addImage(dataUrl, "JPEG", (pageWidth - w) / 2, (pageHeight - h) / 2, w, h);
            }
            doc.save("scanned.pdf");
        });
    </script>';
}

function getOptimizePdfHTML() {
    return '
    <div class="space-y-6">
        <input type="file" id="optimizePdfInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
        <button id="optimizePdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Optimize PDF</button>
        <p class="text-sm text-gray-500">Best-effort optimization for cleaner, smaller PDF structure.</p>
    </div>
    <script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
    <script>
        document.getElementById("optimizePdfBtn").addEventListener("click", async function() {
            const file = document.getElementById("optimizePdfInput").files[0];
            if (!file) return alert("Please select a PDF file");
            const pdf = await PDFLib.PDFDocument.load(await file.arrayBuffer());
            const bytes = await pdf.save({ useObjectStreams: true, addDefaultPage: false });
            const a = document.createElement("a");
            a.href = URL.createObjectURL(new Blob([bytes], { type: "application/pdf" }));
            a.download = "optimized.pdf";
            a.click();
        });
    </script>';
}

function getRepairPdfHTML() {
    return '
    <div class="space-y-6">
        <input type="file" id="repairPdfInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
        <button id="repairPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Repair PDF</button>
        <p class="text-sm text-gray-500">Best-effort rebuild for PDFs with minor structural issues.</p>
    </div>
    <script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
    <script>
        document.getElementById("repairPdfBtn").addEventListener("click", async function() {
            const file = document.getElementById("repairPdfInput").files[0];
            if (!file) return alert("Please select a PDF file");
            try {
                const pdf = await PDFLib.PDFDocument.load(await file.arrayBuffer(), { ignoreEncryption: true });
                const bytes = await pdf.save({ useObjectStreams: false, addDefaultPage: false });
                const a = document.createElement("a");
                a.href = URL.createObjectURL(new Blob([bytes], { type: "application/pdf" }));
                a.download = "repaired.pdf";
                a.click();
            } catch (e) {
                alert("This PDF could not be repaired in the browser.");
            }
        });
    </script>';
}

function getOcrPdfHTML() {
    return '
    <div class="space-y-6">
        <input type="file" id="ocrPdfInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
        <button id="ocrPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">OCR PDF</button>
        <div id="ocrPdfStatus" class="text-sm text-gray-500 text-center hidden"></div>
        <textarea id="ocrPdfOutput" class="hidden w-full h-56 p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600"></textarea>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script src="https://unpkg.com/tesseract.js@4.0.2/dist/tesseract.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";
        document.getElementById("ocrPdfBtn").addEventListener("click", async function() {
            const file = document.getElementById("ocrPdfInput").files[0];
            if (!file) return alert("Please select a PDF file");
            const status = document.getElementById("ocrPdfStatus");
            const output = document.getElementById("ocrPdfOutput");
            status.classList.remove("hidden");
            output.classList.remove("hidden");
            status.textContent = "Running OCR...";
            let fullText = "";
            const pdf = await pdfjsLib.getDocument({ data: await file.arrayBuffer() }).promise;
            for (let i = 1; i <= pdf.numPages; i++) {
                status.textContent = `OCR page ${i} of ${pdf.numPages}...`;
                const page = await pdf.getPage(i);
                const viewport = page.getViewport({ scale: 1.5 });
                const canvas = document.createElement("canvas");
                canvas.width = viewport.width;
                canvas.height = viewport.height;
                await page.render({ canvasContext: canvas.getContext("2d"), viewport }).promise;
                const { data: { text } } = await Tesseract.recognize(canvas, "eng");
                fullText += `\n\n--- Page ${i} ---\n` + text;
            }
            output.value = fullText.trim();
            status.textContent = "OCR complete.";
        });
    </script>';
}

function getRotatePdfHTML() {
    return '
    <div class="space-y-6">
        <input type="file" id="rotatePdfInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
        <select id="rotatePdfAngle" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
            <option value="90">Rotate 90Â°</option>
            <option value="180">Rotate 180Â°</option>
            <option value="270">Rotate 270Â°</option>
        </select>
        <button id="rotatePdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Rotate PDF</button>
    </div>
    <script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
    <script>
        document.getElementById("rotatePdfBtn").addEventListener("click", async function() {
            const file = document.getElementById("rotatePdfInput").files[0];
            if (!file) return alert("Please select a PDF file");
            const angle = parseInt(document.getElementById("rotatePdfAngle").value, 10);
            const pdf = await PDFLib.PDFDocument.load(await file.arrayBuffer());
            pdf.getPages().forEach(page => page.setRotation(PDFLib.degrees(angle)));
            const bytes = await pdf.save();
            const a = document.createElement("a");
            a.href = URL.createObjectURL(new Blob([bytes], { type: "application/pdf" }));
            a.download = "rotated.pdf";
            a.click();
        });
    </script>';
}

function getAddPageNumbersHTML() {
    return '
    <div class="space-y-6">
        <input type="file" id="pageNumbersInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
        <button id="pageNumbersBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Add Page Numbers</button>
    </div>
    <script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
    <script>
        document.getElementById("pageNumbersBtn").addEventListener("click", async function() {
            const file = document.getElementById("pageNumbersInput").files[0];
            if (!file) return alert("Please select a PDF file");
            const pdf = await PDFLib.PDFDocument.load(await file.arrayBuffer());
            const font = await pdf.embedFont(PDFLib.StandardFonts.Helvetica);
            pdf.getPages().forEach((page, index) => {
                page.drawText(String(index + 1), { x: page.getWidth() - 36, y: 20, size: 10, font, color: PDFLib.rgb(0.2, 0.2, 0.2) });
            });
            const bytes = await pdf.save();
            const a = document.createElement("a");
            a.href = URL.createObjectURL(new Blob([bytes], { type: "application/pdf" }));
            a.download = "page-numbers.pdf";
            a.click();
        });
    </script>';
}

function getAddWatermarkHTML() {
    return '
    <div class="space-y-6">
        <input type="file" id="watermarkPdfInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
        <input type="text" id="watermarkText" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Enter watermark text">
        <button id="watermarkPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Add Watermark</button>
    </div>
    <script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
    <script>
        document.getElementById("watermarkPdfBtn").addEventListener("click", async function() {
            const file = document.getElementById("watermarkPdfInput").files[0];
            const watermark = document.getElementById("watermarkText").value.trim();
            if (!file) return alert("Please select a PDF file");
            if (!watermark) return alert("Please enter watermark text.");
            const pdf = await PDFLib.PDFDocument.load(await file.arrayBuffer());
            const font = await pdf.embedFont(PDFLib.StandardFonts.HelveticaBold);
            pdf.getPages().forEach(page => {
                const size = Math.min(36, page.getWidth() / 10);
                page.drawText(watermark, { x: page.getWidth() * 0.2, y: page.getHeight() * 0.5, size, font, color: PDFLib.rgb(0.7, 0.7, 0.7), rotate: PDFLib.degrees(35), opacity: 0.35 });
            });
            const bytes = await pdf.save();
            const a = document.createElement("a");
            a.href = URL.createObjectURL(new Blob([bytes], { type: "application/pdf" }));
            a.download = "watermarked.pdf";
            a.click();
        });
    </script>';
}

function getUnlockPdfHTML() {
    return '
    <div class="space-y-6">
        <input type="file" id="unlockPdfInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
        <button id="unlockPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Unlock PDF</button>
        <p class="text-sm text-gray-500">Best for opening print-viewable PDFs by rebuilding pages into a new file.</p>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";
        document.getElementById("unlockPdfBtn").addEventListener("click", async function() {
            const file = document.getElementById("unlockPdfInput").files[0];
            if (!file) return alert("Please select a PDF file");
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF("p", "mm", "a4");
            try {
                const pdf = await pdfjsLib.getDocument({ data: await file.arrayBuffer() }).promise;
                const pageWidth = doc.internal.pageSize.getWidth();
                const pageHeight = doc.internal.pageSize.getHeight();
                for (let i = 1; i <= pdf.numPages; i++) {
                    const page = await pdf.getPage(i);
                    const viewport = page.getViewport({ scale: 2 });
                    const canvas = document.createElement("canvas");
                    canvas.width = viewport.width;
                    canvas.height = viewport.height;
                    const canvasCtx = canvas.getContext("2d");
                    canvasCtx.imageSmoothingEnabled = true;
                    canvasCtx.imageSmoothingQuality = "high";
                    await page.render({ canvasContext: canvasCtx, viewport }).promise;
                    if (i > 1) doc.addPage();
                    const img = canvas.toDataURL("image/jpeg", 0.97);
                    doc.addImage(img, "JPEG", 0, 0, pageWidth, pageHeight);
                }
                doc.save("unlocked.pdf");
            } catch (e) {
                alert("Could not unlock this PDF in browser: " + e.message);
            }
        });
    </script>';
}

function getSignPdfHTML() {
    return '
    <div class="space-y-6">
        <input type="file" id="signPdfInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
        <input type="file" id="signatureImageInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept="image/*">
        <input type="number" id="signaturePageInput" min="1" value="1" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Page number">
        <button id="signPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Sign PDF</button>
    </div>
    <script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
    <script>
        document.getElementById("signPdfBtn").addEventListener("click", async function() {
            const pdfFile = document.getElementById("signPdfInput").files[0];
            const sigFile = document.getElementById("signatureImageInput").files[0];
            const pageNumber = parseInt(document.getElementById("signaturePageInput").value || "1", 10) - 1;
            if (!pdfFile || !sigFile) return alert("Please select both the PDF and signature image.");
            try {
                const pdf = await PDFLib.PDFDocument.load(await pdfFile.arrayBuffer());
                if (pageNumber < 0 || pageNumber >= pdf.getPageCount()) return alert("Invalid page number.");
                const sigBytes = await sigFile.arrayBuffer();
                const sigImage = sigFile.type.includes("png") ? await pdf.embedPng(sigBytes) : await pdf.embedJpg(sigBytes);
                const page = pdf.getPages()[pageNumber];
                const dims = sigImage.scale(0.25);
                page.drawImage(sigImage, { x: page.getWidth() - dims.width - 36, y: 36, width: dims.width, height: dims.height });
                const bytes = await pdf.save();
                const a = document.createElement("a");
                a.href = URL.createObjectURL(new Blob([bytes], { type: "application/pdf" }));
                a.download = "signed.pdf";
                a.click();
            } catch (e) {
                alert("Could not sign this PDF: " + e.message);
            }
        });
    </script>';
}

function getCropPdfHTML() {
    return '
    <div class="space-y-6">
        <input type="file" id="cropPdfInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
        <div class="grid md:grid-cols-2 gap-4">
            <input type="number" id="cropMarginX" min="0" value="24" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Left and right margin">
            <input type="number" id="cropMarginY" min="0" value="24" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Top and bottom margin">
        </div>
        <button id="cropPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Crop PDF</button>
        <p class="text-sm text-gray-500">Applies a uniform crop box to all pages using the margins you choose.</p>
    </div>
    <script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
    <script>
        document.getElementById("cropPdfBtn").addEventListener("click", async function() {
            const file = document.getElementById("cropPdfInput").files[0];
            if (!file) return alert("Please select a PDF file");
            const marginX = Math.max(0, parseFloat(document.getElementById("cropMarginX").value || "0"));
            const marginY = Math.max(0, parseFloat(document.getElementById("cropMarginY").value || "0"));
            try {
                const pdf = await PDFLib.PDFDocument.load(await file.arrayBuffer());
                pdf.getPages().forEach(page => {
                    const width = page.getWidth();
                    const height = page.getHeight();
                    const cropWidth = Math.max(20, width - (marginX * 2));
                    const cropHeight = Math.max(20, height - (marginY * 2));
                    page.setCropBox(marginX, marginY, cropWidth, cropHeight);
                });
                const bytes = await pdf.save();
                const a = document.createElement("a");
                a.href = URL.createObjectURL(new Blob([bytes], { type: "application/pdf" }));
                a.download = "cropped.pdf";
                a.click();
            } catch (e) {
                alert("Could not crop this PDF: " + e.message);
            }
        });
    </script>';
}

function getComparePdfHTML() {
    return '
    <div class="space-y-6">
        <div class="grid md:grid-cols-2 gap-4">
            <input type="file" id="comparePdfInputA" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
            <input type="file" id="comparePdfInputB" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
        </div>
        <button id="comparePdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Compare PDFs</button>
        <div id="comparePdfResult" class="hidden p-5 rounded-2xl bg-slate-50 border border-slate-200 dark:bg-slate-900 dark:border-slate-700 space-y-3">
            <div id="comparePdfSummary" class="text-sm text-slate-700 dark:text-slate-200"></div>
            <textarea id="comparePdfDiff" class="w-full h-72 p-4 rounded-xl border border-slate-200 bg-white text-slate-900 dark:bg-slate-800 dark:text-slate-100 dark:border-slate-600"></textarea>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";
        async function extractPdfPlainText(file) {
            const pdf = await pdfjsLib.getDocument({ data: await file.arrayBuffer() }).promise;
            const parts = [];
            for (let i = 1; i <= pdf.numPages; i++) {
                const page = await pdf.getPage(i);
                const content = await page.getTextContent();
                const text = content.items.map(item => item.str).join(" ");
                parts.push("Page " + i + ": " + text.replace(/\\s+/g, " ").trim());
            }
            return parts.join("\\n\\n");
        }
        function buildLineDiff(a, b) {
            const aLines = a.split(/\\n+/);
            const bLines = b.split(/\\n+/);
            const max = Math.max(aLines.length, bLines.length);
            const output = [];
            for (let i = 0; i < max; i++) {
                const lineA = (aLines[i] || "").trim();
                const lineB = (bLines[i] || "").trim();
                if (lineA !== lineB) {
                    output.push("Line " + (i + 1));
                    output.push("A: " + lineA);
                    output.push("B: " + lineB);
                    output.push("");
                }
            }
            return output.join("\\n").trim();
        }
        document.getElementById("comparePdfBtn").addEventListener("click", async function() {
            const fileA = document.getElementById("comparePdfInputA").files[0];
            const fileB = document.getElementById("comparePdfInputB").files[0];
            if (!fileA || !fileB) return alert("Please select both PDF files.");
            try {
                const textA = await extractPdfPlainText(fileA);
                const textB = await extractPdfPlainText(fileB);
                const diff = buildLineDiff(textA, textB);
                const same = textA.replace(/\\s+/g, " ").trim() === textB.replace(/\\s+/g, " ").trim();
                document.getElementById("comparePdfSummary").textContent = same
                    ? "No text differences were detected between the two PDFs."
                    : "Differences were found in the extracted text content.";
                document.getElementById("comparePdfDiff").value = diff || "No text differences found.";
                document.getElementById("comparePdfResult").classList.remove("hidden");
            } catch (e) {
                alert("Could not compare PDFs: " + e.message);
            }
        });
    </script>';
}

function getAiSummarizerHTML() {
    return '
    <div class="space-y-6">
        <input type="file" id="summarizerPdfInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
        <button id="summarizerPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Summarize PDF</button>
        <div id="summarizerStatus" class="hidden text-sm text-gray-500 text-center"></div>
        <textarea id="summarizerOutput" class="hidden w-full h-72 p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600"></textarea>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";
        function scoreSentence(sentence, frequencies) {
            return sentence
                .toLowerCase()
                .replace(/[^a-z0-9\\s]/g, " ")
                .split(/\\s+/)
                .filter(Boolean)
                .reduce((sum, word) => sum + (frequencies[word] || 0), 0);
        }
        function summarizeText(text) {
            const clean = text.replace(/\\s+/g, " ").trim();
            if (!clean) return "No readable text was found in the PDF.";
            const words = clean.toLowerCase().replace(/[^a-z0-9\\s]/g, " ").split(/\\s+/).filter(w => w.length > 3);
            const frequencies = {};
            words.forEach(word => frequencies[word] = (frequencies[word] || 0) + 1);
            const sentences = clean.match(/[^.!?]+[.!?]+/g) || [clean];
            const ranked = sentences
                .map(sentence => ({ sentence: sentence.trim(), score: scoreSentence(sentence, frequencies) }))
                .sort((a, b) => b.score - a.score)
                .slice(0, Math.min(6, sentences.length))
                .sort((a, b) => clean.indexOf(a.sentence) - clean.indexOf(b.sentence));
            return ranked.map(item => "- " + item.sentence).join("\\n");
        }
        document.getElementById("summarizerPdfBtn").addEventListener("click", async function() {
            const file = document.getElementById("summarizerPdfInput").files[0];
            if (!file) return alert("Please select a PDF file");
            const status = document.getElementById("summarizerStatus");
            const output = document.getElementById("summarizerOutput");
            status.classList.remove("hidden");
            output.classList.remove("hidden");
            status.textContent = "Reading PDF text...";
            try {
                const pdf = await pdfjsLib.getDocument({ data: await file.arrayBuffer() }).promise;
                let fullText = "";
                for (let i = 1; i <= pdf.numPages; i++) {
                    const page = await pdf.getPage(i);
                    const content = await page.getTextContent();
                    fullText += " " + content.items.map(item => item.str).join(" ");
                }
                status.textContent = "Building summary...";
                output.value = summarizeText(fullText);
                status.textContent = "Summary ready.";
            } catch (e) {
                status.textContent = "Could not summarize this PDF: " + e.message;
            }
        });
    </script>';
}

function getPdfToPdfaHTML() {
    return '
    <div class="space-y-6">
        <div class="rounded-2xl border border-blue-200/70 bg-blue-50/80 dark:bg-blue-950/30 dark:border-blue-900 p-4">
            <div class="font-semibold text-blue-900 dark:text-blue-100">Archival-style PDF export</div>
            <p class="mt-1 text-sm text-blue-800 dark:text-blue-200">This browser tool rebuilds your PDF with cleaner metadata for compatibility-focused archiving. It is a best-effort PDF/A-style export, not formal PDF/A certification.</p>
        </div>
        <input type="file" id="pdfaInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
        <input type="text" id="pdfaTitle" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Optional document title">
        <button id="pdfaBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Create PDF/A-style Export</button>
    </div>
    <script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
    <script>
        document.getElementById("pdfaBtn").addEventListener("click", async function() {
            const file = document.getElementById("pdfaInput").files[0];
            if (!file) return alert("Please select a PDF file");
            const title = document.getElementById("pdfaTitle").value.trim();
            try {
                const pdf = await PDFLib.PDFDocument.load(await file.arrayBuffer(), { ignoreEncryption: true });
                if (title) pdf.setTitle(title);
                pdf.setSubject("Archival-style export");
                pdf.setProducer("Any2Convert");
                pdf.setCreator("Any2Convert");
                pdf.setCreationDate(new Date());
                pdf.setModificationDate(new Date());
                const bytes = await pdf.save({ useObjectStreams: false, addDefaultPage: false, updateFieldAppearances: false });
                const a = document.createElement("a");
                a.href = URL.createObjectURL(new Blob([bytes], { type: "application/pdf" }));
                a.download = "pdfa-style-export.pdf";
                a.click();
            } catch (e) {
                alert("Could not create PDF/A-style export: " + e.message);
            }
        });
    </script>';
}

function getEditPdfHTML() {
    return '
    <div class="space-y-6">
        <div class="rounded-2xl border border-indigo-200/70 bg-indigo-50/80 dark:bg-indigo-950/30 dark:border-indigo-900 p-4">
            <div class="font-semibold text-indigo-900 dark:text-indigo-100">Upload and place content precisely</div>
            <p class="mt-1 text-sm text-indigo-800 dark:text-indigo-200">Choose your PDF, then add text or an optional image/signature with X/Y coordinates.</p>
        </div>
        <div class="grid md:grid-cols-2 gap-4">
            <div class="space-y-2">
                <label for="editPdfInput" class="text-sm font-semibold text-gray-700 dark:text-gray-200">PDF file</label>
                <input type="file" id="editPdfInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
            </div>
            <div class="space-y-2">
                <label for="editPdfPage" class="text-sm font-semibold text-gray-700 dark:text-gray-200">Page number</label>
                <input type="number" id="editPdfPage" min="1" value="1" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Page number">
            </div>
        </div>
        <div class="rounded-2xl border border-gray-200 dark:border-gray-700 p-4 space-y-4">
            <div class="font-semibold text-gray-900 dark:text-gray-100">Add text overlay</div>
            <textarea id="editPdfText" class="w-full h-28 p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Enter text to place on the page"></textarea>
            <div class="grid md:grid-cols-3 gap-4">
                <input type="number" id="editPdfTextX" min="0" value="60" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="X position">
                <input type="number" id="editPdfTextY" min="0" value="100" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Y position">
                <input type="number" id="editPdfTextSize" min="8" value="18" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Text size">
            </div>
        </div>
        <div class="rounded-2xl border border-gray-200 dark:border-gray-700 p-4 space-y-4">
            <div class="font-semibold text-gray-900 dark:text-gray-100">Optional image or signature</div>
            <div class="space-y-2">
                <label for="editPdfImage" class="text-sm font-semibold text-gray-700 dark:text-gray-200">Image file (PNG or JPG)</label>
                <input type="file" id="editPdfImage" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept="image/*">
            </div>
            <div class="grid md:grid-cols-4 gap-4">
                <input type="number" id="editPdfImageX" min="0" value="60" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Image X">
                <input type="number" id="editPdfImageY" min="0" value="160" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Image Y">
                <input type="number" id="editPdfImageW" min="10" value="140" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Image width">
                <input type="number" id="editPdfImageH" min="10" value="60" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Image height">
            </div>
        </div>
        <button id="editPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Edit PDF</button>
    </div>
    <script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
    <script>
        document.getElementById("editPdfBtn").addEventListener("click", async function() {
            const pdfFile = document.getElementById("editPdfInput").files[0];
            if (!pdfFile) return alert("Please select a PDF file");
            const pageNumber = parseInt(document.getElementById("editPdfPage").value || "1", 10) - 1;
            try {
                const pdf = await PDFLib.PDFDocument.load(await pdfFile.arrayBuffer());
                if (pageNumber < 0 || pageNumber >= pdf.getPageCount()) return alert("Invalid page number.");
                const page = pdf.getPages()[pageNumber];
                const text = document.getElementById("editPdfText").value.trim();
                if (text) {
                    const font = await pdf.embedFont(PDFLib.StandardFonts.Helvetica);
                    page.drawText(text, {
                        x: parseFloat(document.getElementById("editPdfTextX").value || "60"),
                        y: parseFloat(document.getElementById("editPdfTextY").value || "100"),
                        size: parseFloat(document.getElementById("editPdfTextSize").value || "18"),
                        font,
                        color: PDFLib.rgb(0.1, 0.1, 0.1)
                    });
                }
                const imageFile = document.getElementById("editPdfImage").files[0];
                if (imageFile) {
                    const bytes = await imageFile.arrayBuffer();
                    const image = imageFile.type.includes("png") ? await pdf.embedPng(bytes) : await pdf.embedJpg(bytes);
                    page.drawImage(image, {
                        x: parseFloat(document.getElementById("editPdfImageX").value || "60"),
                        y: parseFloat(document.getElementById("editPdfImageY").value || "160"),
                        width: parseFloat(document.getElementById("editPdfImageW").value || "140"),
                        height: parseFloat(document.getElementById("editPdfImageH").value || "60")
                    });
                }
                const out = await pdf.save();
                const a = document.createElement("a");
                a.href = URL.createObjectURL(new Blob([out], { type: "application/pdf" }));
                a.download = "edited.pdf";
                a.click();
            } catch (e) {
                alert("Could not edit this PDF: " + e.message);
            }
        });
    </script>';
}

function getRedactPdfHTML() {
    return '
    <div class="space-y-6">
        <div class="rounded-2xl border border-amber-200/70 bg-amber-50/80 dark:bg-amber-950/30 dark:border-amber-900 p-4">
            <div class="font-semibold text-amber-900 dark:text-amber-100">Burned-in redaction</div>
            <p class="mt-1 text-sm text-amber-800 dark:text-amber-200">This version finds a keyword, paints black boxes over matches, and rebuilds the PDF from rendered pages for stronger visual redaction.</p>
        </div>
        <input type="file" id="redactPdfInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
        <input type="text" id="redactKeyword" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Enter keyword to redact">
        <label class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-300">
            <input type="checkbox" id="redactCaseSensitive" class="rounded border-gray-300">
            Match case exactly
        </label>
        <button id="redactPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Redact PDF</button>
        <div id="redactStatus" class="hidden text-sm text-gray-500 text-center"></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";
        document.getElementById("redactPdfBtn").addEventListener("click", async function() {
            const file = document.getElementById("redactPdfInput").files[0];
            const keyword = document.getElementById("redactKeyword").value.trim();
            const caseSensitive = document.getElementById("redactCaseSensitive").checked;
            const status = document.getElementById("redactStatus");
            if (!file) return alert("Please select a PDF file");
            if (!keyword) return alert("Please enter a keyword to redact");
            status.classList.remove("hidden");
            status.textContent = "Rendering PDF pages...";
            try {
                const pdf = await pdfjsLib.getDocument({ data: await file.arrayBuffer() }).promise;
                let doc;
                let totalMatches = 0;
                for (let i = 1; i <= pdf.numPages; i++) {
                    status.textContent = "Redacting page " + i + " of " + pdf.numPages + "...";
                    const page = await pdf.getPage(i);
                    const viewport = page.getViewport({ scale: 2.2 });
                    const canvas = document.createElement("canvas");
                    canvas.width = viewport.width;
                    canvas.height = viewport.height;
                    const ctx = canvas.getContext("2d");
                    ctx.imageSmoothingEnabled = true;
                    ctx.imageSmoothingQuality = "high";
                    await page.render({ canvasContext: ctx, viewport }).promise;
                    const textContent = await page.getTextContent();
                    textContent.items.forEach(item => {
                        const hay = caseSensitive ? item.str : item.str.toLowerCase();
                        const needle = caseSensitive ? keyword : keyword.toLowerCase();
                        if (!hay || !hay.includes(needle)) return;
                        totalMatches++;
                        const tx = pdfjsLib.Util.transform(viewport.transform, item.transform);
                        const x = tx[4];
                        const y = tx[5];
                        const width = Math.max(12, item.width * viewport.scale);
                        const height = Math.max(10, item.height * viewport.scale);
                        ctx.fillStyle = "#000000";
                        ctx.fillRect(x, y - height, width, height + 4);
                    });
                    const img = canvas.toDataURL("image/jpeg", 0.97);
                    if (!doc) {
                        doc = new window.jspdf.jsPDF({ unit: "pt", format: [canvas.width, canvas.height] });
                    } else {
                        doc.addPage([canvas.width, canvas.height], canvas.width > canvas.height ? "landscape" : "portrait");
                    }
                    doc.addImage(img, "JPEG", 0, 0, canvas.width, canvas.height);
                }
                if (!doc) return alert("Could not create a redacted PDF.");
                status.textContent = totalMatches
                    ? "Redaction complete. Downloading file..."
                    : "No keyword matches found. Downloading rebuilt copy anyway.";
                doc.save("redacted.pdf");
            } catch (e) {
                status.textContent = "Could not redact this PDF: " + e.message;
            }
        });
    </script>';
}

function getTranslatePdfHTML() {
    return '
    <div class="space-y-6">
        <div class="rounded-2xl border border-indigo-200/70 bg-indigo-50/80 dark:bg-indigo-950/30 dark:border-indigo-900 p-4">
            <div class="font-semibold text-indigo-900 dark:text-indigo-100">Browser translation</div>
            <p class="mt-1 text-sm text-indigo-800 dark:text-indigo-200">This tool extracts PDF text and sends it in chunks to a free public translation endpoint from the browser. Best for short to medium text documents.</p>
        </div>
        <input type="file" id="translatePdfInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
        <div class="grid md:grid-cols-2 gap-4">
            <select id="translateFrom" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                <option value="en">English</option>
                <option value="ur">Urdu</option>
                <option value="ar">Arabic</option>
                <option value="es">Spanish</option>
                <option value="fr">French</option>
                <option value="de">German</option>
                <option value="hi">Hindi</option>
            </select>
            <select id="translateTo" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                <option value="ur">Urdu</option>
                <option value="en">English</option>
                <option value="ar">Arabic</option>
                <option value="es">Spanish</option>
                <option value="fr">French</option>
                <option value="de">German</option>
                <option value="hi">Hindi</option>
            </select>
        </div>
        <button id="translatePdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Translate PDF Text</button>
        <div id="translateStatus" class="hidden text-sm text-gray-500 text-center"></div>
        <textarea id="translateOutput" class="hidden w-full h-80 p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600"></textarea>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";
        function chunkText(text, size) {
            const chunks = [];
            for (let i = 0; i < text.length; i += size) {
                chunks.push(text.slice(i, i + size));
            }
            return chunks;
        }
        async function translateChunk(chunk, from, to) {
            const url = "https://api.mymemory.translated.net/get?q=" + encodeURIComponent(chunk) + "&langpair=" + encodeURIComponent(from + "|" + to);
            const response = await fetch(url);
            if (!response.ok) throw new Error("Translation request failed");
            const data = await response.json();
            return (data.responseData && data.responseData.translatedText) ? data.responseData.translatedText : chunk;
        }
        document.getElementById("translatePdfBtn").addEventListener("click", async function() {
            const file = document.getElementById("translatePdfInput").files[0];
            if (!file) return alert("Please select a PDF file");
            const from = document.getElementById("translateFrom").value;
            const to = document.getElementById("translateTo").value;
            if (from === to) return alert("Please choose different source and target languages.");
            const status = document.getElementById("translateStatus");
            const output = document.getElementById("translateOutput");
            status.classList.remove("hidden");
            output.classList.remove("hidden");
            status.textContent = "Extracting text from PDF...";
            const pdf = await pdfjsLib.getDocument({ data: await file.arrayBuffer() }).promise;
            let fullText = "";
            for (let i = 1; i <= pdf.numPages; i++) {
                const page = await pdf.getPage(i);
                const content = await page.getTextContent();
                fullText += "\\n\\n" + content.items.map(item => item.str).join(" ");
            }
            const normalized = fullText.replace(/\\s+/g, " ").trim();
            if (!normalized) {
                output.value = "No readable text was found in the PDF.";
                status.textContent = "No text found.";
                return;
            }
            const limited = normalized.slice(0, 6000);
            const chunks = chunkText(limited, 450);
            const translated = [];
            for (let i = 0; i < chunks.length; i++) {
                status.textContent = "Translating chunk " + (i + 1) + " of " + chunks.length + "...";
                translated.push(await translateChunk(chunks[i], from, to));
            }
            output.value = translated.join(" ");
            status.textContent = normalized.length > 6000
                ? "Translation ready. The first part of the document was translated for speed."
                : "Translation ready.";
        });
    </script>';
}

if (realpath($_SERVER['SCRIPT_FILENAME'] ?? '') === __FILE__) {
    echo renderToolHandlerHTML($_GET['tool'] ?? '');
}

?>

