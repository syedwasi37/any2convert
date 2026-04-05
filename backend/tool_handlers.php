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
        case 'sql_to_json':
            return getSqlToJsonHTML();
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
        case 'heic_converter':
            return getHeicConverterHTML();
        case 'jpg_converter':
            return getJpgConverterHTML();
        case 'webp_converter':
            return getWebpConverterHTML();
        case 'video_to_audio':
            return getVideoToAudioHTML();
        case 'video_compressor':
            return getVideoCompressorHTML();
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
        case 'invoice_generator':
            return getInvoiceGeneratorHTML();
        case 'ats_resume_checker':
            return getAtsResumeCheckerHTML();
        case 'social_image_resizer':
            return getSocialImageResizerHTML();
        case 'jwt_decoder':
            return getJwtDecoderHTML();
        case 'bank_statement_to_excel':
            return getBankStatementToExcelHTML();
        case 'grammar_checker':
            return getGrammarCheckerHTML();
        case 'paraphrase_tool':
            return getParaphraseToolHTML();
        case 'percentage_calculator':
            return getPercentageCalculatorHTML();
        case 'loan_calculator':
            return getLoanCalculatorHTML();
        case 'bmi_calculator':
            return getBmiCalculatorHTML();
        case 'age_calculator':
            return getAgeCalculatorHTML();
        case 'sensitivity_converter':
            return getSensitivityConverterHTML();
        case 'reaction_time_test':
            return getReactionTimeTestHTML();
        case 'cps_test':
            return getCpsTestHTML();
        case 'gamer_tag_generator':
            return getGamerTagGeneratorHTML();
        case 'clip_to_gif':
            return getClipToGifHTML();
        case 'tournament_bracket_generator':
            return getTournamentBracketGeneratorHTML();
        case 'spin_wheel':
            return getSpinWheelHTML();
        case 'random_name_picker':
            return getRandomNamePickerHTML();
        case 'typing_speed_test':
            return getTypingSpeedTestHTML();
        case 'meme_caption_generator':
            return getMemeCaptionGeneratorHTML();
        case 'truth_or_dare_generator':
            return getTruthOrDareGeneratorHTML();
        case 'memory_match_game':
            return getMemoryMatchGameHTML();
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
    $presetsJson = base64_encode(json_encode($config['presets'] ?? [], JSON_UNESCAPED_SLASHES));
    $decimals = (int) ($config['decimals'] ?? 6);
    $defaultValue = htmlspecialchars((string) ($config['default_value'] ?? '1'), ENT_QUOTES);
    $formulaText = htmlspecialchars($config['formula_text'] ?? 'Results update instantly as you type.', ENT_QUOTES);
    $defaultFrom = htmlspecialchars((string) ($config['default_from'] ?? ''), ENT_QUOTES);
    $defaultTo = htmlspecialchars((string) ($config['default_to'] ?? ''), ENT_QUOTES);
    $inputPlaceholder = htmlspecialchars((string) ($config['input_placeholder'] ?? 'Enter a value'), ENT_QUOTES);
    $badge = htmlspecialchars((string) ($config['badge'] ?? 'Smart Converter'), ENT_QUOTES);
    $icon = htmlspecialchars((string) ($config['icon'] ?? '<>'), ENT_QUOTES);

    return '
    <div class="space-y-6">
        <div class="grid 2xl:grid-cols-[1.12fr_0.88fr] gap-6">
            <div class="rounded-[2rem] border border-slate-200/80 dark:border-slate-700/70 bg-gradient-to-br from-white via-blue-50/70 to-cyan-50/70 dark:from-slate-900 dark:via-slate-900 dark:to-slate-950 p-6 shadow-[0_24px_70px_rgba(15,23,42,0.08)]">
                <div class="flex items-start justify-between gap-4 mb-5">
                    <div>
                        <p class="text-[11px] font-black uppercase tracking-[0.22em] text-blue-600 dark:text-blue-400">' . $badge . '</p>
                        <h3 class="text-2xl font-black text-gray-900 dark:text-white mt-2">' . $title . '</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-3 max-w-2xl">' . $description . '</p>
                    </div>
                    <div class="hidden sm:flex items-center justify-center w-14 h-14 rounded-2xl bg-blue-600/10 text-blue-600 dark:bg-blue-500/15 dark:text-blue-300 text-xl">' . $icon . '</div>
                </div>
                <div id="unitConverterPresets" class="flex flex-wrap gap-2 mb-4"></div>
                <div class="grid md:grid-cols-[1.25fr_0.75fr] gap-4">
                    <div class="rounded-[1.6rem] border border-slate-200/80 dark:border-slate-700/80 bg-white/85 dark:bg-slate-950/70 p-4">
                        <label class="block text-[11px] font-black uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400 mb-2">Enter value</label>
                        <input type="number" id="unitConverterValue" value="' . $defaultValue . '" step="any" placeholder="' . $inputPlaceholder . '" class="w-full min-h-[62px] px-5 py-4 rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-2xl font-black text-gray-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-3">Type any number and the result updates instantly.</p>
                    </div>
                    <div class="rounded-[1.6rem] border border-slate-200/80 dark:border-slate-700/80 bg-white/85 dark:bg-slate-950/70 p-4">
                        <label class="block text-[11px] font-black uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400 mb-2">Precision</label>
                        <input type="range" id="unitConverterPrecision" min="0" max="' . $decimals . '" value="' . min(4, $decimals) . '" class="w-full mt-2 accent-blue-600">
                        <div class="mt-3 flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                            <span>Rounded output</span>
                            <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-700 dark:bg-blue-500/15 dark:text-blue-300 font-black"><span id="unitConverterPrecisionValue">' . min(4, $decimals) . '</span> dp</span>
                        </div>
                    </div>
                </div>
                <div class="grid md:grid-cols-[1fr_auto_1fr] gap-4 items-end mt-4">
                    <div class="rounded-[1.6rem] border border-slate-200/80 dark:border-slate-700/80 bg-white/85 dark:bg-slate-950/70 p-4">
                        <label class="block text-[11px] font-black uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400 mb-2">Convert from</label>
                        <select id="unitConverterFrom" class="w-full min-h-[62px] px-5 py-4 rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-[15px] font-bold text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500/30"></select>
                    </div>
                    <button id="unitConverterSwap" class="h-[62px] w-[62px] rounded-2xl bg-blue-600 text-white font-black text-xl hover:bg-blue-700 transition shadow-lg shadow-blue-500/20">&#8646;</button>
                    <div class="rounded-[1.6rem] border border-slate-200/80 dark:border-slate-700/80 bg-white/85 dark:bg-slate-950/70 p-4">
                        <label class="block text-[11px] font-black uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400 mb-2">Convert to</label>
                        <select id="unitConverterTo" class="w-full min-h-[62px] px-5 py-4 rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-[15px] font-bold text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500/30"></select>
                    </div>
                </div>
                <div class="mt-5 flex flex-wrap gap-3">
                    <button id="unitConverterCopy" class="px-5 py-3 rounded-2xl bg-emerald-600 text-white font-bold hover:bg-emerald-700 transition">Copy Result</button>
                    <div class="px-4 py-3 rounded-2xl bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300 text-sm font-semibold">Fast, private, and client-side</div>
                </div>
                <p id="unitConverterStatus" class="text-sm text-gray-500 dark:text-gray-400 mt-4">' . $formulaText . '</p>
            </div>
            <div class="rounded-[2rem] border border-slate-200/80 dark:border-slate-700/70 bg-gradient-to-br from-slate-50 via-white to-blue-50/50 dark:from-slate-950 dark:via-slate-950 dark:to-slate-900 p-6">
                <p class="text-[11px] font-black uppercase tracking-[0.22em] text-blue-600 dark:text-blue-400">Live Preview</p>
                <div class="mt-4 rounded-[1.8rem] bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-6 shadow-sm">
                    <p id="unitConverterResultText" class="text-4xl font-black tracking-tight text-gray-900 dark:text-white">0</p>
                    <p id="unitConverterFormula" class="text-sm text-gray-500 dark:text-gray-400 mt-3 leading-6">Choose units to start converting.</p>
                </div>
                <div class="mt-4 rounded-[1.8rem] bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5">
                    <div class="flex items-center justify-between gap-3">
                        <h4 class="font-black text-gray-900 dark:text-white">Quick conversions</h4>
                        <span class="text-xs font-black uppercase tracking-[0.18em] text-gray-400">Popular</span>
                    </div>
                    <div id="unitConverterQuickGrid" class="mt-4 grid sm:grid-cols-2 gap-3"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        (() => {
            const units = JSON.parse(atob("' . $unitsJson . '"));
            const presets = JSON.parse(atob("' . $presetsJson . '"));
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
            const presetsWrap = document.getElementById("unitConverterPresets");

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

            function renderPresets() {
                if (!presetsWrap || !Array.isArray(presets) || !presets.length) return;
                presetsWrap.innerHTML = "";
                presets.forEach((preset) => {
                    const button = document.createElement("button");
                    button.type = "button";
                    button.className = "px-3 py-2 rounded-full border border-slate-200 dark:border-slate-700 bg-white/90 dark:bg-slate-900 text-xs font-black uppercase tracking-[0.16em] text-slate-600 dark:text-slate-300 hover:border-blue-400 hover:text-blue-600 transition";
                    button.textContent = preset.label || "Preset";
                    button.addEventListener("click", () => {
                        if (preset.value !== undefined) valueInput.value = preset.value;
                        if (preset.from && units[preset.from]) fromSelect.value = preset.from;
                        if (preset.to && units[preset.to]) toSelect.value = preset.to;
                        update();
                    });
                    presetsWrap.appendChild(button);
                });
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
                    card.className = "rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-950 px-4 py-3";
                    const converted = convertValue(currentValue, fromKey, key);
                    card.innerHTML = `<p class="text-[11px] font-black uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400">${unit.short || unit.label}</p><p class="text-lg font-black text-gray-900 dark:text-white mt-2">${formatNumber(converted, Number(precisionInput.value))}</p><p class="text-xs text-gray-400 dark:text-gray-500 mt-1">${unit.label}</p>`;
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
            renderPresets();
            update();
        })();
    </script>';
}

function getLengthConverterHTML(): string
{
    return getGenericUnitConverterHTML([
        'title' => 'Length Converter',
        'description' => 'Convert between kilometers, meters, centimeters, millimeters, inches, feet, yards, and miles instantly.',
        'badge' => 'Distance & Size',
        'icon' => 'LEN',
        'input_placeholder' => 'Example: 1.5',
        'default_value' => '1',
        'default_from' => 'km',
        'default_to' => 'mm',
        'formula_text' => 'Perfect for km to millimeter, inch to centimeter, or mile to meter conversions.',
        'presets' => [
            ['label' => '1 km to mm', 'value' => 1, 'from' => 'km', 'to' => 'mm'],
            ['label' => '6 ft to cm', 'value' => 6, 'from' => 'ft', 'to' => 'cm'],
            ['label' => '3 mi to km', 'value' => 3, 'from' => 'mi', 'to' => 'km'],
        ],
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
        'badge' => 'Mass & Weight',
        'icon' => 'WT',
        'input_placeholder' => 'Example: 72',
        'default_value' => '1',
        'default_from' => 'kg',
        'default_to' => 'lb',
        'presets' => [
            ['label' => '1 kg to lb', 'value' => 1, 'from' => 'kg', 'to' => 'lb'],
            ['label' => '500 g to oz', 'value' => 500, 'from' => 'g', 'to' => 'oz'],
            ['label' => '2 lb to g', 'value' => 2, 'from' => 'lb', 'to' => 'g'],
        ],
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
        'badge' => 'Weather & Science',
        'icon' => 'TMP',
        'input_placeholder' => 'Example: 25',
        'default_value' => '25',
        'default_from' => 'c',
        'default_to' => 'f',
        'presets' => [
            ['label' => 'Room temp', 'value' => 25, 'from' => 'c', 'to' => 'f'],
            ['label' => 'Boiling point', 'value' => 100, 'from' => 'c', 'to' => 'f'],
            ['label' => 'Freezing point', 'value' => 32, 'from' => 'f', 'to' => 'c'],
        ],
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
        'badge' => 'Land & Space',
        'icon' => 'AREA',
        'input_placeholder' => 'Example: 1200',
        'default_value' => '1',
        'default_from' => 'sqft',
        'default_to' => 'sqm',
        'presets' => [
            ['label' => '1200 sq ft', 'value' => 1200, 'from' => 'sqft', 'to' => 'sqm'],
            ['label' => '1 acre to ha', 'value' => 1, 'from' => 'acre', 'to' => 'hectare'],
            ['label' => '5000 sq m', 'value' => 5000, 'from' => 'sqm', 'to' => 'acre'],
        ],
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
        'badge' => 'Liquid & Capacity',
        'icon' => 'VOL',
        'input_placeholder' => 'Example: 2.5',
        'default_value' => '1',
        'default_from' => 'l',
        'default_to' => 'gal',
        'presets' => [
            ['label' => '1 L to gal', 'value' => 1, 'from' => 'l', 'to' => 'gal'],
            ['label' => '500 mL to cup', 'value' => 500, 'from' => 'ml', 'to' => 'cup'],
            ['label' => '2 gal to L', 'value' => 2, 'from' => 'gal', 'to' => 'l'],
        ],
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
        'badge' => 'Travel & Motion',
        'icon' => 'SPD',
        'input_placeholder' => 'Example: 60',
        'default_value' => '60',
        'default_from' => 'kmh',
        'default_to' => 'mph',
        'presets' => [
            ['label' => '60 km/h', 'value' => 60, 'from' => 'kmh', 'to' => 'mph'],
            ['label' => '100 mph', 'value' => 100, 'from' => 'mph', 'to' => 'kmh'],
            ['label' => '20 kn', 'value' => 20, 'from' => 'knot', 'to' => 'kmh'],
        ],
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
        'badge' => 'Duration & Time',
        'icon' => 'TIME',
        'input_placeholder' => 'Example: 3',
        'default_value' => '1',
        'default_from' => 'hour',
        'default_to' => 'min',
        'presets' => [
            ['label' => '1 hr to min', 'value' => 1, 'from' => 'hour', 'to' => 'min'],
            ['label' => '7 days to hr', 'value' => 7, 'from' => 'day', 'to' => 'hour'],
            ['label' => '12 mo to yr', 'value' => 12, 'from' => 'month', 'to' => 'year'],
        ],
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
        <div class="grid xl:grid-cols-[1.2fr_0.8fr] gap-6">
            <div class="rounded-[2rem] border border-slate-200/80 dark:border-slate-700/70 bg-gradient-to-br from-white via-emerald-50/70 to-blue-50/70 dark:from-slate-900 dark:via-slate-900 dark:to-slate-950 p-6 shadow-[0_24px_70px_rgba(15,23,42,0.08)]">
                <div class="flex items-start justify-between gap-4 mb-5">
                    <div>
                        <p class="text-[11px] font-black uppercase tracking-[0.22em] text-emerald-600 dark:text-emerald-400">Live Rates</p>
                        <h3 class="text-2xl font-black text-gray-900 dark:text-white mt-2">Live Currency Converter</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-3 max-w-2xl">Convert between major currencies with live daily rates from Frankfurter using official institutions and central-bank sources.</p>
                    </div>
                    <div class="hidden sm:flex items-center justify-center w-14 h-14 rounded-2xl bg-emerald-600/10 text-emerald-600 dark:bg-emerald-500/15 dark:text-emerald-300 text-xl">$</div>
                </div>
                <div id="currencyPresets" class="flex flex-wrap gap-2 mb-4"></div>
                <div class="grid lg:grid-cols-[1.35fr_0.65fr] gap-4">
                    <div class="rounded-[1.6rem] border border-slate-200/80 dark:border-slate-700/80 bg-white/85 dark:bg-slate-950/70 p-4">
                        <label class="block text-[11px] font-black uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400 mb-2">Amount</label>
                        <input type="number" id="currencyAmount" value="1" step="any" placeholder="Enter amount" class="w-full min-h-[62px] px-5 py-4 rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-2xl font-black text-gray-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/30">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-3">Enter any amount and compare it live.</p>
                    </div>
                    <div class="rounded-[1.6rem] border border-slate-200/80 dark:border-slate-700/80 bg-white/85 dark:bg-slate-950/70 p-4">
                        <label class="block text-[11px] font-black uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400 mb-2">Rate sync</label>
                        <button id="currencyRefreshBtn" class="w-full min-h-[62px] px-5 py-4 rounded-2xl bg-blue-600 text-white font-bold hover:bg-blue-700 transition">Refresh Live Rates</button>
                        <div class="mt-3 text-xs text-gray-500 dark:text-gray-400">Pull the latest available market reference.</div>
                    </div>
                </div>
                <div class="grid lg:grid-cols-[1fr_auto_1fr] gap-4 items-end mt-4">
                    <div class="rounded-[1.6rem] border border-slate-200/80 dark:border-slate-700/80 bg-white/85 dark:bg-slate-950/70 p-4">
                        <label class="block text-[11px] font-black uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400 mb-2">From currency</label>
                        <div id="currencyFromDisplay" class="mb-3"></div>
                        <select id="currencyFrom" class="w-full min-h-[62px] px-5 py-4 rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-[15px] font-bold text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500/30"></select>
                    </div>
                    <button id="currencySwapBtn" class="h-[62px] w-[62px] rounded-2xl bg-emerald-600 text-white font-black text-xl hover:bg-emerald-700 transition shadow-lg shadow-emerald-500/20">&#8646;</button>
                    <div class="rounded-[1.6rem] border border-slate-200/80 dark:border-slate-700/80 bg-white/85 dark:bg-slate-950/70 p-4">
                        <label class="block text-[11px] font-black uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400 mb-2">To currency</label>
                        <div id="currencyToDisplay" class="mb-3"></div>
                        <select id="currencyTo" class="w-full min-h-[62px] px-5 py-4 rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-[15px] font-bold text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500/30"></select>
                    </div>
                </div>
                <div class="mt-5 flex flex-wrap gap-3">
                    <button id="currencyCopyBtn" class="px-5 py-3 rounded-2xl bg-emerald-600 text-white font-bold hover:bg-emerald-700 transition">Copy Result</button>
                    <div class="px-4 py-3 rounded-2xl bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300 text-sm font-semibold">Daily reference rates, no key required</div>
                </div>
                <p id="currencyStatus" class="text-sm text-gray-500 dark:text-gray-400 mt-4">Loading latest currency list and rates...</p>
            </div>
            <div class="rounded-[2rem] border border-slate-200/80 dark:border-slate-700/70 bg-gradient-to-br from-slate-50 via-white to-emerald-50/60 dark:from-slate-950 dark:via-slate-950 dark:to-slate-900 p-6">
                <p class="text-[11px] font-black uppercase tracking-[0.22em] text-emerald-600 dark:text-emerald-400">Live Output</p>
                <div class="mt-4 rounded-[1.8rem] bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-6 shadow-sm">
                    <p id="currencyResultText" class="text-4xl font-black tracking-tight text-gray-900 dark:text-white">--</p>
                    <p id="currencyMetaText" class="text-sm text-gray-500 dark:text-gray-400 mt-3 leading-6">Waiting for live rates.</p>
                </div>
                <div class="mt-4 rounded-[1.8rem] bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5">
                    <div class="flex items-center justify-between gap-3">
                        <h4 class="font-black text-gray-900 dark:text-white">Quick rates</h4>
                        <span class="text-xs font-black uppercase tracking-[0.18em] text-gray-400">Market view</span>
                    </div>
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
            const fromDisplay = document.getElementById("currencyFromDisplay");
            const toDisplay = document.getElementById("currencyToDisplay");
            const presetsWrap = document.getElementById("currencyPresets");

            let currencies = {};
            const preferred = ["USD", "EUR", "GBP", "PKR", "AED", "SAR", "INR", "CAD", "AUD", "JPY"];
            const presets = [
                { label: "USD to PKR", from: "USD", to: "PKR", value: 1 },
                { label: "EUR to USD", from: "EUR", to: "USD", value: 1 },
                { label: "AED to PKR", from: "AED", to: "PKR", value: 100 },
                { label: "GBP to INR", from: "GBP", to: "INR", value: 50 }
            ];

            function currencyCountryCode(code) {
                const map = {
                    EUR: "EU",
                    XAF: "CM",
                    XCD: "AG",
                    XCG: "CW",
                    XOF: "SN",
                    XPF: "PF",
                    ANG: "CW"
                };
                if (map[code]) return map[code];
                if (!code || code.length < 2) return "";
                return code.slice(0, 2);
            }

            function currencyLabel(code) {
                const item = currencies[code];
                return typeof item === "string" ? item : (item?.name || code);
            }

            function currencyFlagUrl(code) {
                const countryCode = currencyCountryCode(code);
                return countryCode ? `https://flagcdn.com/48x36/${countryCode.toLowerCase()}.png` : "";
            }

            function currencyFlagMarkup(code, size = "w-8 h-6") {
                const url = currencyFlagUrl(code);
                if (!url) {
                    return `<div class="${size} rounded-lg bg-slate-200 dark:bg-slate-700"></div>`;
                }
                return `<img src="${url}" alt="${code} flag" class="${size} rounded-md object-cover shadow-sm" loading="lazy" referrerpolicy="no-referrer">`;
            }

            function renderCurrencyDisplay(target, code) {
                if (!target) return;
                target.innerHTML = `
                    <div class="flex items-center gap-3 rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 min-w-0 overflow-hidden">
                        ${currencyFlagMarkup(code, "w-10 h-7")}
                        <div class="min-w-0 overflow-hidden">
                            <div class="text-sm font-black text-slate-900 dark:text-white">${code}</div>
                            <div class="text-xs text-slate-500 dark:text-slate-400 truncate">${currencyLabel(code)}</div>
                        </div>
                    </div>`;
            }

            function syncCurrencyDisplays() {
                renderCurrencyDisplay(fromDisplay, fromSelect.value);
                renderCurrencyDisplay(toDisplay, toSelect.value);
            }

            function renderCurrencyPresets() {
                if (!presetsWrap) return;
                presetsWrap.innerHTML = "";
                presets.forEach((preset) => {
                    const button = document.createElement("button");
                    button.type = "button";
                    button.className = "px-3 py-2 rounded-full border border-slate-200 dark:border-slate-700 bg-white/90 dark:bg-slate-900 text-xs font-black uppercase tracking-[0.16em] text-slate-600 dark:text-slate-300 hover:border-emerald-400 hover:text-emerald-600 transition";
                    button.textContent = preset.label;
                    button.addEventListener("click", () => {
                        amountInput.value = preset.value;
                        fromSelect.value = preset.from;
                        toSelect.value = preset.to;
                        updateRates();
                    });
                    presetsWrap.appendChild(button);
                });
            }

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
                        option.textContent = `${code} - ${currencyLabel(code)}`;
                        select.appendChild(option);
                    });
                });
                fromSelect.value = "USD";
                toSelect.value = "PKR";
                syncCurrencyDisplays();
                renderCurrencyPresets();
            }

            function renderQuickRates(base, rates) {
                quickRates.innerHTML = "";
                preferred.filter((code) => code !== base && rates[code]).slice(0, 6).forEach((code) => {
                    const card = document.createElement("div");
                    card.className = "rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-950 px-4 py-4";
                    card.innerHTML = `<div class="flex items-center justify-between gap-3"><div class="flex items-center gap-2 min-w-0">${currencyFlagMarkup(code, "w-7 h-5")}<div class="min-w-0"><p class="text-sm font-black text-slate-900 dark:text-white">${code}</p><p class="text-[11px] text-slate-500 dark:text-slate-400 truncate">${currencyLabel(code)}</p></div></div><div class="text-right"><p class="text-lg font-black text-gray-900 dark:text-white">${Number(rates[code]).toFixed(4)}</p><p class="text-[11px] text-slate-400">per 1 ${base}</p></div></div>`;
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
                    syncCurrencyDisplays();
                    resultText.innerHTML = `<span class="flex flex-wrap items-center gap-3 break-words">${currencyFlagMarkup(quote, "w-10 h-7")}<span class="break-all">${formatAmount(converted, quote)}</span></span>`;
                    metaText.innerHTML = `<span class="flex flex-wrap items-center gap-2 leading-6 break-words"><span class="inline-flex items-center gap-2">${currencyFlagMarkup(base, "w-6 h-4")}<span>${amount || 0} ${base}</span></span><span>=</span><span class="inline-flex items-center gap-2">${currencyFlagMarkup(quote, "w-6 h-4")}<span>${converted.toFixed(4)} ${quote}</span></span><span>using live rate ${Number(rate).toFixed(6)} on ${dateLabel || "latest update"}.</span></span>`;
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

function getInvoiceGeneratorHTML() {
    return <<<'HTML'
    <div class="max-w-6xl mx-auto">
        <div class="grid xl:grid-cols-[1.15fr_0.85fr] gap-6">
            <div class="rounded-[32px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/70 shadow-xl shadow-slate-200/50 dark:shadow-black/20 p-6 md:p-7 space-y-6">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-[11px] tracking-[0.34em] uppercase text-emerald-500 font-semibold">Business Tool</p>
                        <h2 class="mt-2 text-3xl font-black text-slate-900 dark:text-white">Invoice Generator</h2>
                        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Create a printable invoice with tax, line items, and a live preview.</p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-emerald-500/15 text-emerald-500 flex items-center justify-center">
                        <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 3h7l5 5v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Z"/><path d="M14 3v5h5"/><path d="M9 13h6"/><path d="M9 17h6"/><path d="M9 9h2"/></svg>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-4">
                    <label class="block"><span class="text-xs uppercase tracking-[0.22em] text-slate-500">Business Name</span><input id="invoiceBusiness" class="mt-2 w-full rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-slate-900 dark:text-white" placeholder="Any2Convert Studio"></label>
                    <label class="block"><span class="text-xs uppercase tracking-[0.22em] text-slate-500">Client Name</span><input id="invoiceClient" class="mt-2 w-full rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-slate-900 dark:text-white" placeholder="Client or company"></label>
                    <label class="block"><span class="text-xs uppercase tracking-[0.22em] text-slate-500">Invoice Number</span><input id="invoiceNumber" class="mt-2 w-full rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-slate-900 dark:text-white" placeholder="INV-2026-001"></label>
                    <label class="block"><span class="text-xs uppercase tracking-[0.22em] text-slate-500">Currency</span><select id="invoiceCurrency" class="mt-2 w-full rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-slate-900 dark:text-white"><option value="$">USD ($)</option><option value="PKR">PKR</option><option value="AED">AED</option><option value="EUR">EUR</option><option value="GBP">GBP</option></select></label>
                    <label class="block"><span class="text-xs uppercase tracking-[0.22em] text-slate-500">Issue Date</span><input id="invoiceIssueDate" type="date" class="mt-2 w-full rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-slate-900 dark:text-white"></label>
                    <label class="block"><span class="text-xs uppercase tracking-[0.22em] text-slate-500">Due Date</span><input id="invoiceDueDate" type="date" class="mt-2 w-full rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-slate-900 dark:text-white"></label>
                </div>
                <div class="grid md:grid-cols-[1fr_170px] gap-4">
                    <label class="block"><span class="text-xs uppercase tracking-[0.22em] text-slate-500">Business Details</span><textarea id="invoiceBusinessMeta" rows="3" class="mt-2 w-full rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-slate-900 dark:text-white" placeholder="Address, email, phone"></textarea></label>
                    <label class="block"><span class="text-xs uppercase tracking-[0.22em] text-slate-500">Tax %</span><input id="invoiceTax" type="number" min="0" step="0.1" value="0" class="mt-2 w-full rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-slate-900 dark:text-white"></label>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-sm font-semibold text-slate-900 dark:text-white">Line Items</p>
                        <button id="addInvoiceItem" class="rounded-2xl bg-emerald-500 text-white px-4 py-2 text-sm font-semibold">Add Item</button>
                    </div>
                    <div id="invoiceItems" class="space-y-3"></div>
                </div>
                <label class="block"><span class="text-xs uppercase tracking-[0.22em] text-slate-500">Notes</span><textarea id="invoiceNotes" rows="3" class="mt-2 w-full rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-slate-900 dark:text-white" placeholder="Payment terms, thank-you note, bank details"></textarea></label>
                <div class="flex flex-wrap gap-3">
                    <button id="invoicePrint" class="rounded-2xl bg-slate-900 dark:bg-white text-white dark:text-slate-900 px-5 py-3 font-semibold">Print Invoice</button>
                    <button id="invoiceDownload" class="rounded-2xl bg-blue-600 text-white px-5 py-3 font-semibold">Download HTML</button>
                    <p id="invoiceStatus" class="text-sm text-slate-500 dark:text-slate-400 self-center">Invoice preview updates automatically.</p>
                </div>
            </div>
            <div class="rounded-[32px] border border-slate-200 dark:border-slate-800 bg-slate-50/85 dark:bg-slate-950/80 shadow-xl shadow-slate-200/50 dark:shadow-black/20 p-4 md:p-5">
                <div id="invoicePreview" class="rounded-[28px] bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-6 min-h-[760px] text-slate-900 dark:text-white"></div>
            </div>
        </div>
    </div>
    <script>
        (() => {
            const itemsWrap = document.getElementById("invoiceItems");
            const preview = document.getElementById("invoicePreview");
            const status = document.getElementById("invoiceStatus");
            const inputs = ["invoiceBusiness","invoiceClient","invoiceNumber","invoiceCurrency","invoiceIssueDate","invoiceDueDate","invoiceBusinessMeta","invoiceTax","invoiceNotes"].map((id) => document.getElementById(id));
            document.getElementById("invoiceIssueDate").valueAsDate = new Date();
            const due = new Date(); due.setDate(due.getDate() + 7); document.getElementById("invoiceDueDate").valueAsDate = due;
            function addItemRow(data = {}) {
                const row = document.createElement("div");
                row.className = "grid md:grid-cols-[1.6fr_120px_140px_52px] gap-3";
                row.innerHTML = `<input class="item-desc rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-slate-900 dark:text-white" placeholder="Design package" value="${data.desc || ""}"><input class="item-qty rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-slate-900 dark:text-white" type="number" min="1" step="1" value="${data.qty || 1}"><input class="item-price rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-slate-900 dark:text-white" type="number" min="0" step="0.01" value="${data.price || 0}"><button class="remove-item rounded-2xl bg-rose-500/12 text-rose-500 font-bold">�</button>`;
                row.querySelectorAll("input").forEach((el) => el.addEventListener("input", renderInvoice));
                row.querySelector(".remove-item").addEventListener("click", () => { row.remove(); renderInvoice(); });
                itemsWrap.appendChild(row);
            }
            function money(value) { const symbol = document.getElementById("invoiceCurrency").value || "$"; return `${symbol} ${Number(value || 0).toFixed(2)}`; }
            function renderInvoice() {
                const rows = Array.from(itemsWrap.children).map((row) => {
                    const desc = row.querySelector(".item-desc").value || "Service item";
                    const qty = parseFloat(row.querySelector(".item-qty").value) || 0;
                    const price = parseFloat(row.querySelector(".item-price").value) || 0;
                    return { desc, qty, price, total: qty * price };
                });
                const subtotal = rows.reduce((sum, row) => sum + row.total, 0);
                const taxRate = parseFloat(document.getElementById("invoiceTax").value) || 0;
                const taxValue = subtotal * (taxRate / 100);
                const total = subtotal + taxValue;
                preview.innerHTML = `<div class="flex items-start justify-between gap-6 border-b border-slate-200 dark:border-slate-800 pb-5"><div><p class="text-xs tracking-[0.3em] uppercase text-emerald-500 font-semibold">Invoice</p><h3 class="mt-2 text-3xl font-black">${document.getElementById("invoiceBusiness").value || "Your Business"}</h3><p class="mt-2 text-sm text-slate-500 dark:text-slate-400 whitespace-pre-line">${document.getElementById("invoiceBusinessMeta").value || "Business details will appear here."}</p></div><div class="text-right text-sm"><p><span class="text-slate-500">Invoice #</span> <strong>${document.getElementById("invoiceNumber").value || "INV-001"}</strong></p><p class="mt-2"><span class="text-slate-500">Issued</span> <strong>${document.getElementById("invoiceIssueDate").value || "--"}</strong></p><p class="mt-2"><span class="text-slate-500">Due</span> <strong>${document.getElementById("invoiceDueDate").value || "--"}</strong></p></div></div><div class="grid md:grid-cols-2 gap-4 py-5"><div><p class="text-xs tracking-[0.25em] uppercase text-slate-500">Bill To</p><p class="mt-2 text-lg font-bold">${document.getElementById("invoiceClient").value || "Client Name"}</p></div><div class="md:text-right"><p class="text-xs tracking-[0.25em] uppercase text-slate-500">Total Due</p><p class="mt-2 text-3xl font-black text-emerald-500">${money(total)}</p></div></div><div class="rounded-3xl overflow-hidden border border-slate-200 dark:border-slate-800"><table class="w-full text-sm"><thead class="bg-slate-100 dark:bg-slate-800/70"><tr><th class="text-left px-4 py-3">Item</th><th class="text-left px-4 py-3">Qty</th><th class="text-left px-4 py-3">Price</th><th class="text-right px-4 py-3">Total</th></tr></thead><tbody>${rows.map((row) => `<tr class="border-t border-slate-200 dark:border-slate-800"><td class="px-4 py-3">${row.desc}</td><td class="px-4 py-3">${row.qty}</td><td class="px-4 py-3">${money(row.price)}</td><td class="px-4 py-3 text-right font-semibold">${money(row.total)}</td></tr>`).join("") || '<tr><td colspan="4" class="px-4 py-5 text-center text-slate-500">Add line items to build the invoice.</td></tr>'}</tbody></table></div><div class="mt-5 space-y-2 text-sm"><div class="flex items-center justify-between"><span class="text-slate-500">Subtotal</span><strong>${money(subtotal)}</strong></div><div class="flex items-center justify-between"><span class="text-slate-500">Tax (${taxRate.toFixed(1)}%)</span><strong>${money(taxValue)}</strong></div><div class="flex items-center justify-between text-lg"><span class="font-bold">Grand Total</span><strong class="text-emerald-500">${money(total)}</strong></div></div><div class="mt-6 rounded-3xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 p-4"><p class="text-xs tracking-[0.22em] uppercase text-slate-500">Notes</p><p class="mt-2 text-sm whitespace-pre-line">${document.getElementById("invoiceNotes").value || "Thanks for your business."}</p></div>`;
                status.textContent = `Subtotal ${money(subtotal)} updated.`;
            }
            document.getElementById("addInvoiceItem").addEventListener("click", () => addItemRow());
            inputs.forEach((input) => input.addEventListener("input", renderInvoice));
            document.getElementById("invoicePrint").addEventListener("click", () => window.print());
            document.getElementById("invoiceDownload").addEventListener("click", () => { const blob = new Blob([`<html><head><meta charset="UTF-8"><title>Invoice</title></head><body>${preview.innerHTML}</body></html>`], { type: "text/html" }); const url = URL.createObjectURL(blob); const a = document.createElement("a"); a.href = url; a.download = "invoice.html"; a.click(); URL.revokeObjectURL(url); });
            addItemRow({ desc: "Creative service", qty: 1, price: 150 }); addItemRow({ desc: "Revision support", qty: 2, price: 40 }); renderInvoice();
        })();
    </script>
HTML;
}

function getAtsResumeCheckerHTML() {
    return <<<'HTML'
    <div class="max-w-6xl mx-auto grid xl:grid-cols-[1.05fr_0.95fr] gap-6">
        <div class="rounded-[32px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 shadow-xl p-6 md:p-7 space-y-5">
            <div style="display:none;">
                <h1>ATS Resume Checker Free Online</h1>
                <p>Use this ATS resume checker to scan your resume, improve ATS resume keywords, and check your ATS resume score against a job description.</p>
                <p>Find missing ATS resume keywords, test your ATS resume format, and use this free ATS resume checker online before you apply.</p>
                <p>If you want to know what is an ATS resume, what is ATS resume scanning, or how an ATS resume scanner works, this tool gives you a fast ATS resume test in your browser.</p>
            </div>
            <div class="flex items-start justify-between gap-4"><div><p class="text-[11px] tracking-[0.34em] uppercase text-fuchsia-500 font-semibold">ATS Resume Tool</p><h2 class="mt-2 text-3xl font-black text-slate-900 dark:text-white">ATS Resume Checker</h2><p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Use this free ATS resume checker to compare your resume with a job description, scan ATS resume keywords, and improve your ATS resume score.</p></div><div class="w-14 h-14 rounded-2xl bg-fuchsia-500/15 text-fuchsia-500 flex items-center justify-center"><svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 3h10a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z"/><path d="M9 8h6"/><path d="M9 12h6"/><path d="M9 16h4"/></svg></div></div>
            <div class="grid md:grid-cols-2 gap-4">
                <label class="block"><span class="text-xs uppercase tracking-[0.22em] text-slate-500">Paste Resume</span><textarea id="atsResume" rows="16" class="mt-2 w-full rounded-3xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-4 text-slate-900 dark:text-white" placeholder="Paste your ATS resume, ATS resume template, experience, education, and skills..."></textarea></label>
                <label class="block"><span class="text-xs uppercase tracking-[0.22em] text-slate-500">Paste Job Description</span><textarea id="atsJob" rows="16" class="mt-2 w-full rounded-3xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-4 text-slate-900 dark:text-white" placeholder="Paste the target role requirements, ATS resume keywords, skills, and responsibilities..."></textarea></label>
            </div>
            <div class="rounded-3xl border border-fuchsia-200/70 dark:border-fuchsia-500/15 bg-fuchsia-50/70 dark:bg-fuchsia-500/10 p-4 text-sm text-fuchsia-900 dark:text-fuchsia-100">Check your ATS resume format, ATS resume keywords, and overall ATS resume score with this free ATS resume scanner.</div>
            <div class="flex flex-wrap gap-3"><button id="atsAnalyze" class="rounded-2xl bg-fuchsia-600 text-white px-5 py-3 font-semibold">Analyze ATS Resume</button><button id="atsDemo" class="rounded-2xl bg-slate-200 dark:bg-slate-800 text-slate-900 dark:text-white px-5 py-3 font-semibold">Load Demo</button><p id="atsStatus" class="text-sm text-slate-500 dark:text-slate-400 self-center">This ATS resume checker free scan uses keyword overlap, section coverage, and measurable impact signals.</p></div>
        </div>
        <div class="space-y-6">
            <div class="rounded-[32px] border border-slate-200 dark:border-slate-800 bg-slate-50/85 dark:bg-slate-950/80 shadow-xl p-6"><p class="text-xs tracking-[0.28em] uppercase text-slate-500">ATS Score</p><div class="mt-4 flex items-end gap-3"><div id="atsScore" class="text-6xl font-black text-slate-900 dark:text-white">0</div><div class="text-xl font-semibold text-slate-500 mb-2">/ 100</div></div><div class="mt-4 h-3 rounded-full bg-slate-200 dark:bg-slate-800 overflow-hidden"><div id="atsBar" class="h-full rounded-full bg-gradient-to-r from-fuchsia-500 to-violet-500" style="width:0%"></div></div><p id="atsSummary" class="mt-4 text-sm text-slate-500 dark:text-slate-400">Paste your resume and job description to get suggestions.</p></div>
            <div class="rounded-[32px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 shadow-xl p-6"><h3 class="text-xl font-black text-slate-900 dark:text-white">Missing Keywords</h3><div id="atsKeywords" class="mt-4 flex flex-wrap gap-2"></div></div>
            <div class="rounded-[32px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 shadow-xl p-6"><h3 class="text-xl font-black text-slate-900 dark:text-white">Actionable Notes</h3><ul id="atsTips" class="mt-4 space-y-3 text-sm text-slate-600 dark:text-slate-300"></ul></div>
        </div>
    </div>
    <script>
        (() => {
            const resumeInput = document.getElementById("atsResume"), jobInput = document.getElementById("atsJob"), scoreEl = document.getElementById("atsScore"), barEl = document.getElementById("atsBar"), summaryEl = document.getElementById("atsSummary"), keywordsEl = document.getElementById("atsKeywords"), tipsEl = document.getElementById("atsTips"), statusEl = document.getElementById("atsStatus");
            function tokenize(text) { return (text.toLowerCase().match(/[a-z][a-z0-9+#.-]{2,}/g) || []).filter((word) => !["with","from","that","this","have","your","will","into","their","about","using","years","year"].includes(word)); }
            function analyze() {
                const resume = resumeInput.value.trim(), job = jobInput.value.trim();
                if (!resume || !job) { statusEl.textContent = "Please provide both a resume and a job description."; return; }
                const resumeLower = resume.toLowerCase(), jobTokens = tokenize(job), frequency = {};
                jobTokens.forEach((token) => frequency[token] = (frequency[token] || 0) + 1);
                const topKeywords = Object.entries(frequency).sort((a, b) => b[1] - a[1]).slice(0, 18).map(([word]) => word);
                const missing = topKeywords.filter((word) => !resumeLower.includes(word)).slice(0, 10);
                const matched = topKeywords.length - missing.length;
                const keywordScore = topKeywords.length ? (matched / topKeywords.length) * 55 : 0;
                const sections = ["experience","skills","education","projects","summary"], foundSections = sections.filter((section) => resumeLower.includes(section));
                const total = Math.round(Math.min(100, keywordScore + (foundSections.length / sections.length) * 25 + (/\d/.test(resume) ? 10 : 0) + (/(built|led|managed|launched|improved|optimized|delivered|designed)/i.test(resume) ? 10 : 0)));
                scoreEl.textContent = total; barEl.style.width = total + "%";
                summaryEl.textContent = total >= 80 ? "Strong match. Fine-tune the missing keywords and measurable impact." : total >= 60 ? "Decent match. Add missing terms and sharpen role-specific experience." : "Low match. Rework your summary, skills, and impact bullets around the job description.";
                keywordsEl.innerHTML = missing.length ? missing.map((word) => `<span class="px-3 py-2 rounded-full bg-rose-500/10 text-rose-500 text-sm font-semibold">${word}</span>`).join("") : '<span class="px-3 py-2 rounded-full bg-emerald-500/10 text-emerald-500 text-sm font-semibold">No major keyword gaps found</span>';
                const tips = [foundSections.length < sections.length ? `Add missing sections: ${sections.filter((section) => !foundSections.includes(section)).join(", ")}.` : "Core resume sections are present.", missing.length ? `Work these terms naturally into your resume: ${missing.slice(0, 5).join(", ")}.` : "Keyword alignment looks strong for the top terms.", /\d/.test(resume) ? "You already use measurable numbers. Keep that impact language." : "Add numbers like revenue, response time, users, or conversion gains.", /(built|led|managed|launched|improved|optimized|delivered|designed)/i.test(resume) ? "Action verbs are present. Nice." : "Start bullets with action verbs like built, led, improved, or optimized."];
                tipsEl.innerHTML = tips.map((tip) => `<li class="rounded-2xl bg-slate-100 dark:bg-slate-900 px-4 py-3">${tip}</li>`).join("");
                statusEl.textContent = `Checked ${topKeywords.length} key terms and ${foundSections.length}/${sections.length} major sections.`;
            }
            document.getElementById("atsAnalyze").addEventListener("click", analyze);
            document.getElementById("atsDemo").addEventListener("click", () => { resumeInput.value = "Product designer with 4 years of experience designing landing pages, dashboards, and design systems. Led redesign projects that improved conversion by 24%. Skills: Figma, UX research, wireframing, prototyping, accessibility, collaboration. Experience: designed flows with product managers and engineers. Education: BBA."; jobInput.value = "We are hiring a product designer with experience in Figma, prototyping, design systems, accessibility, UX research, collaboration, dashboards, experimentation, stakeholder communication, and measurable product impact."; analyze(); });
        })();
    </script>
HTML;
}

function getSocialImageResizerHTML() {
    return <<<'HTML'
    <div class="max-w-6xl mx-auto grid xl:grid-cols-[1fr_0.95fr] gap-6">
        <div class="rounded-[32px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 shadow-xl p-6 md:p-7 space-y-5">
            <div class="flex items-start justify-between gap-4"><div><p class="text-[11px] tracking-[0.34em] uppercase text-cyan-500 font-semibold">Social Media Tool</p><h2 class="mt-2 text-3xl font-black text-slate-900 dark:text-white">Social Image Resizer</h2><p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Resize one image for Instagram, YouTube, LinkedIn, Facebook, X, and more.</p></div><div class="w-14 h-14 rounded-2xl bg-cyan-500/15 text-cyan-500 flex items-center justify-center"><svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="18" height="18" rx="4"/><path d="M8 8h8v8H8z"/></svg></div></div>
            <div class="grid md:grid-cols-[1fr_240px] gap-4"><label class="block"><span class="text-xs uppercase tracking-[0.22em] text-slate-500">Upload Image</span><input id="socialImageInput" type="file" accept="image/*" class="mt-2 block w-full rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-slate-900 dark:text-white"></label><label class="block"><span class="text-xs uppercase tracking-[0.22em] text-slate-500">Platform Preset</span><select id="socialPreset" class="mt-2 w-full rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-slate-900 dark:text-white"></select></label></div>
            <div class="grid md:grid-cols-2 gap-4"><label class="block"><span class="text-xs uppercase tracking-[0.22em] text-slate-500">Fit Mode</span><select id="socialFit" class="mt-2 w-full rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-slate-900 dark:text-white"><option value="cover">Cover</option><option value="contain">Contain</option></select></label><label class="block"><span class="text-xs uppercase tracking-[0.22em] text-slate-500">Background</span><input id="socialBg" type="color" value="#0f172a" class="mt-2 w-full h-[52px] rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-2 py-2"></label></div>
            <div class="flex flex-wrap gap-3"><button id="socialResize" class="rounded-2xl bg-cyan-600 text-white px-5 py-3 font-semibold">Resize Image</button><button id="socialDownload" class="rounded-2xl bg-slate-900 dark:bg-white text-white dark:text-slate-900 px-5 py-3 font-semibold">Download PNG</button><p id="socialStatus" class="text-sm text-slate-500 dark:text-slate-400 self-center">Choose a platform preset to generate the output.</p></div>
        </div>
        <div class="rounded-[32px] border border-slate-200 dark:border-slate-800 bg-slate-950 shadow-xl p-5 text-white">
            <div class="flex items-center justify-between"><div><p class="text-[11px] tracking-[0.3em] uppercase text-cyan-300">Preview</p><h3 id="socialMeta" class="mt-2 text-xl font-black">Ready for export</h3></div><div id="socialDims" class="text-sm text-slate-300">0 � 0</div></div>
            <div class="mt-5 rounded-[28px] overflow-hidden bg-slate-900 border border-white/10 min-h-[420px] flex items-center justify-center"><canvas id="socialCanvas" class="max-w-full max-h-[480px]"></canvas></div>
        </div>
    </div>
    <script>
        (() => {
            const presets = { instagram_post: { label: "Instagram Post", width: 1080, height: 1080 }, instagram_story: { label: "Instagram Story", width: 1080, height: 1920 }, youtube_thumb: { label: "YouTube Thumbnail", width: 1280, height: 720 }, linkedin_post: { label: "LinkedIn Post", width: 1200, height: 627 }, facebook_post: { label: "Facebook Post", width: 1200, height: 630 }, x_post: { label: "X / Twitter Post", width: 1600, height: 900 }, whatsapp_status: { label: "WhatsApp Status", width: 1080, height: 1920 } };
            const presetSelect = document.getElementById("socialPreset"), input = document.getElementById("socialImageInput"), fitSelect = document.getElementById("socialFit"), bgInput = document.getElementById("socialBg"), canvas = document.getElementById("socialCanvas"), ctx = canvas.getContext("2d"), status = document.getElementById("socialStatus"), dims = document.getElementById("socialDims"), meta = document.getElementById("socialMeta"); let image = null;
            Object.entries(presets).forEach(([value, preset]) => { const option = document.createElement("option"); option.value = value; option.textContent = `${preset.label} (${preset.width}�${preset.height})`; presetSelect.appendChild(option); });
            function draw() {
                const preset = presets[presetSelect.value]; if (!preset) return;
                canvas.width = preset.width; canvas.height = preset.height; ctx.fillStyle = bgInput.value; ctx.fillRect(0, 0, canvas.width, canvas.height); dims.textContent = `${preset.width} � ${preset.height}`; meta.textContent = preset.label;
                if (!image) { status.textContent = "Upload an image first."; return; }
                const scale = fitSelect.value === "cover" ? Math.max(canvas.width / image.width, canvas.height / image.height) : Math.min(canvas.width / image.width, canvas.height / image.height);
                const drawWidth = image.width * scale, drawHeight = image.height * scale, x = (canvas.width - drawWidth) / 2, y = (canvas.height - drawHeight) / 2;
                ctx.drawImage(image, x, y, drawWidth, drawHeight); status.textContent = `Resized for ${preset.label}.`;
            }
            input.addEventListener("change", (event) => { const file = event.target.files?.[0]; if (!file) return; const img = new Image(); img.onload = () => { image = img; draw(); }; img.src = URL.createObjectURL(file); });
            [presetSelect, fitSelect, bgInput].forEach((el) => el.addEventListener("input", draw));
            document.getElementById("socialResize").addEventListener("click", draw);
            document.getElementById("socialDownload").addEventListener("click", () => { if (!canvas.width) return; const a = document.createElement("a"); a.href = canvas.toDataURL("image/png"); a.download = `${presetSelect.value || "social-image"}.png`; a.click(); });
            presetSelect.value = "instagram_post"; draw();
        })();
    </script>
HTML;
}

function getJwtDecoderHTML() {
    return <<<'HTML'
    <div class="max-w-5xl mx-auto grid xl:grid-cols-[1fr_1fr] gap-6">
        <div class="rounded-[32px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 shadow-xl p-6 md:p-7 space-y-5">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-[11px] tracking-[0.34em] uppercase text-amber-500 font-semibold">Developer Tool</p>
                    <h2 class="mt-2 text-3xl font-black text-slate-900 dark:text-white">JWT Decoder</h2>
                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Decode header and payload locally in your browser. No token leaves your device.</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-amber-500/15 text-amber-500 flex items-center justify-center">
                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 7h16"/><path d="M4 12h10"/><path d="M4 17h7"/><rect x="3" y="4" width="18" height="16" rx="3"/></svg>
                </div>
            </div>
            <textarea id="jwtInput" rows="10" class="w-full rounded-3xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-4 text-slate-900 dark:text-white font-mono text-sm" placeholder="Paste JWT token here"></textarea>
            <div class="flex flex-wrap gap-3">
                <button id="jwtDecodeBtn" class="rounded-2xl bg-amber-500 text-slate-950 px-5 py-3 font-semibold">Decode Token</button>
                <button id="jwtDemoBtn" class="rounded-2xl bg-slate-200 dark:bg-slate-800 text-slate-900 dark:text-white px-5 py-3 font-semibold">Load Demo</button>
                <p id="jwtStatus" class="text-sm text-slate-500 dark:text-slate-400 self-center">Header and payload will be shown below.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-4">
                <div class="rounded-3xl bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-4"><p class="text-xs uppercase tracking-[0.22em] text-slate-500">Issuer</p><p id="jwtIss" class="mt-2 font-semibold break-all">--</p></div>
                <div class="rounded-3xl bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-4"><p class="text-xs uppercase tracking-[0.22em] text-slate-500">Subject</p><p id="jwtSub" class="mt-2 font-semibold break-all">--</p></div>
                <div class="rounded-3xl bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-4"><p class="text-xs uppercase tracking-[0.22em] text-slate-500">Expires</p><p id="jwtExp" class="mt-2 font-semibold break-all">--</p></div>
            </div>
        </div>
        <div class="space-y-6">
            <div class="rounded-[32px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 shadow-xl p-6">
                <h3 class="text-xl font-black text-slate-900 dark:text-white">Header</h3>
                <pre id="jwtHeader" class="mt-4 rounded-3xl bg-slate-950 text-emerald-300 p-4 overflow-auto text-xs min-h-[180px]"></pre>
            </div>
            <div class="rounded-[32px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 shadow-xl p-6">
                <h3 class="text-xl font-black text-slate-900 dark:text-white">Payload</h3>
                <pre id="jwtPayload" class="mt-4 rounded-3xl bg-slate-950 text-cyan-300 p-4 overflow-auto text-xs min-h-[280px]"></pre>
            </div>
        </div>
    </div>
    <script>
        (() => {
            const input = document.getElementById("jwtInput"), status = document.getElementById("jwtStatus"), headerEl = document.getElementById("jwtHeader"), payloadEl = document.getElementById("jwtPayload");
            function decodePart(part) {
                const normalized = part.replace(/-/g, "+").replace(/_/g, "/");
                const padded = normalized + "=".repeat((4 - normalized.length % 4) % 4);
                return JSON.parse(decodeURIComponent(Array.prototype.map.call(atob(padded), (c) => "%" + ("00" + c.charCodeAt(0).toString(16)).slice(-2)).join("")));
            }
            function formatDate(value) {
                if (!value) return "--";
                const date = new Date(Number(value) * 1000);
                return isNaN(date.getTime()) ? String(value) : date.toLocaleString();
            }
            function decodeToken() {
                try {
                    const token = input.value.trim();
                    const parts = token.split(".");
                    if (parts.length < 2) throw new Error("Invalid JWT format.");
                    const header = decodePart(parts[0]);
                    const payload = decodePart(parts[1]);
                    headerEl.textContent = JSON.stringify(header, null, 2);
                    payloadEl.textContent = JSON.stringify(payload, null, 2);
                    document.getElementById("jwtIss").textContent = payload.iss || "--";
                    document.getElementById("jwtSub").textContent = payload.sub || payload.email || "--";
                    document.getElementById("jwtExp").textContent = formatDate(payload.exp);
                    status.textContent = "JWT decoded locally.";
                } catch (error) {
                    headerEl.textContent = "";
                    payloadEl.textContent = "";
                    status.textContent = error.message || "Could not decode JWT.";
                }
            }
            document.getElementById("jwtDecodeBtn").addEventListener("click", decodeToken);
            document.getElementById("jwtDemoBtn").addEventListener("click", () => {
                input.value = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJkZW1vQGFueTJjb252ZXJ0LmNvbSIsImlzcyI6IkFueTJDb252ZXJ0IiwiZXhwIjoyMDAwMDAwMDAwLCJyb2xlIjoidXNlciJ9.signature";
                decodeToken();
            });
        })();
    </script>
HTML;
}

function getBankStatementToExcelHTML() {
    return <<<'HTML'
    <div class="max-w-6xl mx-auto grid xl:grid-cols-[0.95fr_1.05fr] gap-6">
        <div class="rounded-[32px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 shadow-xl p-6 md:p-7 space-y-5">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-[11px] tracking-[0.34em] uppercase text-emerald-500 font-semibold">Finance Tool</p>
                    <h2 class="mt-2 text-3xl font-black text-slate-900 dark:text-white">Bank Statement PDF to Excel</h2>
                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Extract statement rows from PDF text and export them as an Excel sheet.</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-emerald-500/15 text-emerald-500 flex items-center justify-center">
                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 3h7l5 5v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Z"/><path d="M14 3v5h5"/><path d="M9 14l2 2 4-4"/></svg>
                </div>
            </div>
            <input id="statementPdfInput" type="file" accept="application/pdf" class="block w-full rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-slate-900 dark:text-white">
            <div class="grid md:grid-cols-2 gap-4">
                <label class="block"><span class="text-xs uppercase tracking-[0.22em] text-slate-500">Date Pattern</span><input id="statementDatePattern" class="mt-2 w-full rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-slate-900 dark:text-white" value="dd/mm/yyyy or dd-mm-yyyy"></label>
                <label class="block"><span class="text-xs uppercase tracking-[0.22em] text-slate-500">Currency Hint</span><input id="statementCurrencyHint" class="mt-2 w-full rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-slate-900 dark:text-white" value="PKR, USD, AED, etc."></label>
            </div>
            <div class="flex flex-wrap gap-3">
                <button id="statementExtractBtn" class="rounded-2xl bg-emerald-500 text-white px-5 py-3 font-semibold">Extract Transactions</button>
                <button id="statementExportBtn" class="rounded-2xl bg-slate-900 dark:bg-white text-white dark:text-slate-900 px-5 py-3 font-semibold">Export Excel</button>
                <p id="statementStatus" class="text-sm text-slate-500 dark:text-slate-400 self-center">Upload a statement PDF to start.</p>
            </div>
        </div>
        <div class="rounded-[32px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 shadow-xl p-5">
            <div class="flex items-center justify-between gap-4">
                <div><p class="text-[11px] tracking-[0.3em] uppercase text-slate-500">Extracted Rows</p><h3 class="mt-2 text-2xl font-black text-slate-900 dark:text-white">Transaction Preview</h3></div>
                <div id="statementCount" class="rounded-full bg-slate-100 dark:bg-slate-900 px-4 py-2 text-sm text-slate-600 dark:text-slate-300">0 rows</div>
            </div>
            <div class="mt-5 overflow-auto rounded-[28px] border border-slate-200 dark:border-slate-800">
                <table class="w-full text-sm">
                    <thead class="bg-slate-100 dark:bg-slate-900">
                        <tr><th class="text-left px-4 py-3">Date</th><th class="text-left px-4 py-3">Description</th><th class="text-left px-4 py-3">Amount</th><th class="text-left px-4 py-3">Balance</th></tr>
                    </thead>
                    <tbody id="statementRows"></tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        (() => {
            const fileInput = document.getElementById("statementPdfInput"), status = document.getElementById("statementStatus"), rowsWrap = document.getElementById("statementRows"), countEl = document.getElementById("statementCount");
            let rows = [];
            async function extractRows() {
                const file = fileInput.files?.[0];
                if (!file) { status.textContent = "Select a PDF statement first."; return; }
                if (!window.pdfjsLib) { status.textContent = "PDF library not loaded."; return; }
                const buffer = await file.arrayBuffer();
                const pdf = await window.pdfjsLib.getDocument({ data: buffer }).promise;
                const allLines = [];
                for (let pageNo = 1; pageNo <= pdf.numPages; pageNo++) {
                    const page = await pdf.getPage(pageNo);
                    const content = await page.getTextContent();
                    const text = content.items.map((item) => item.str).join(" ");
                    text.split(/(?=\d{2}[\/-]\d{2}[\/-]\d{2,4})/).forEach((line) => allLines.push(line.trim()));
                }
                rows = allLines.map((line) => {
                    const match = line.match(/(\d{2}[\/-]\d{2}[\/-]\d{2,4})\s+(.+?)\s+(-?\d[\d,]*\.?\d*)\s+(-?\d[\d,]*\.?\d*)$/);
                    if (!match) return null;
                    return { date: match[1], description: match[2], amount: match[3], balance: match[4] };
                }).filter(Boolean);
                rowsWrap.innerHTML = rows.length ? rows.map((row) => `<tr class="border-t border-slate-200 dark:border-slate-800"><td class="px-4 py-3">${row.date}</td><td class="px-4 py-3">${row.description}</td><td class="px-4 py-3">${row.amount}</td><td class="px-4 py-3">${row.balance}</td></tr>`).join("") : '<tr><td colspan="4" class="px-4 py-6 text-center text-slate-500">No transaction rows detected. Try a clearer statement PDF.</td></tr>';
                countEl.textContent = `${rows.length} rows`;
                status.textContent = rows.length ? "Transactions extracted. Review and export to Excel." : "Could not detect rows automatically.";
            }
            function exportExcel() {
                if (!rows.length) { status.textContent = "Extract rows first."; return; }
                if (!window.XLSX) { status.textContent = "Excel library not loaded."; return; }
                const sheet = window.XLSX.utils.json_to_sheet(rows);
                const wb = window.XLSX.utils.book_new();
                window.XLSX.utils.book_append_sheet(wb, sheet, "Statement");
                window.XLSX.writeFile(wb, "bank-statement.xlsx");
            }
            document.getElementById("statementExtractBtn").addEventListener("click", () => extractRows().catch((error) => status.textContent = error.message || "Extraction failed."));
            document.getElementById("statementExportBtn").addEventListener("click", exportExcel);
        })();
    </script>
HTML;
}

function getGrammarCheckerHTML() {
    return <<<'HTML'
    <div class="max-w-5xl mx-auto grid xl:grid-cols-[1fr_0.95fr] gap-6">
        <div class="rounded-[32px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 shadow-xl p-6 md:p-7 space-y-5">
            <p class="text-[11px] tracking-[0.34em] uppercase text-violet-500 font-semibold">Writing Tool</p>
            <h2 class="text-3xl font-black text-slate-900 dark:text-white">Grammar Checker</h2>
            <textarea id="grammarInput" rows="16" class="w-full rounded-3xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-4 text-slate-900 dark:text-white" placeholder="Paste your text here"></textarea>
            <div class="flex flex-wrap gap-3"><button id="grammarCheckBtn" class="rounded-2xl bg-violet-600 text-white px-5 py-3 font-semibold">Check Grammar</button><button id="grammarDemoBtn" class="rounded-2xl bg-slate-200 dark:bg-slate-800 text-slate-900 dark:text-white px-5 py-3 font-semibold">Load Demo</button><p id="grammarStatus" class="text-sm text-slate-500 dark:text-slate-400 self-center">Basic fixes include casing, punctuation, spacing, and repeated marks.</p></div>
        </div>
        <div class="space-y-6">
            <div class="rounded-[32px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 shadow-xl p-6"><h3 class="text-xl font-black text-slate-900 dark:text-white">Suggestions</h3><ul id="grammarSuggestions" class="mt-4 space-y-3 text-sm text-slate-600 dark:text-slate-300"></ul></div>
            <div class="rounded-[32px] border border-slate-200 dark:border-slate-800 bg-slate-950 shadow-xl p-6"><h3 class="text-xl font-black text-white">Cleaned Text</h3><textarea id="grammarOutput" rows="12" class="mt-4 w-full rounded-3xl bg-slate-900 border border-white/10 px-4 py-4 text-slate-100"></textarea></div>
        </div>
    </div>
    <script>
        (() => {
            const input = document.getElementById("grammarInput"), output = document.getElementById("grammarOutput"), suggestions = document.getElementById("grammarSuggestions"), status = document.getElementById("grammarStatus");
            function runCheck() {
                let text = input.value || "";
                const notes = [];
                if (/\bi\b/.test(text)) { text = text.replace(/\bi\b/g, "I"); notes.push("Capitalized standalone 'i' to 'I'."); }
                if (/\s{2,}/.test(text)) { text = text.replace(/\s{2,}/g, " "); notes.push("Removed extra spaces."); }
                if (/([!?.,])\1+/.test(text)) { text = text.replace(/([!?.,])\1+/g, "$1"); notes.push("Reduced repeated punctuation marks."); }
                if (/\b(dont|cant|wont|im|ive|doesnt|isnt)\b/gi.test(text)) { text = text.replace(/\bdont\b/gi, "don't").replace(/\bcant\b/gi, "can't").replace(/\bwont\b/gi, "won't").replace(/\bim\b/gi, "I'm").replace(/\bive\b/gi, "I've").replace(/\bdoesnt\b/gi, "doesn't").replace(/\bisnt\b/gi, "isn't"); notes.push("Normalized common contractions."); }
                if (text && !/[.!?]$/.test(text.trim())) { text = text.trim() + "."; notes.push("Added ending punctuation."); }
                output.value = text;
                suggestions.innerHTML = notes.length ? notes.map((note) => `<li class="rounded-2xl bg-slate-100 dark:bg-slate-900 px-4 py-3">${note}</li>`).join("") : '<li class="rounded-2xl bg-emerald-500/10 text-emerald-500 px-4 py-3">No obvious quick-fix issues found.</li>';
                status.textContent = notes.length ? `${notes.length} quick grammar improvements applied.` : "Text already looks clean.";
            }
            document.getElementById("grammarCheckBtn").addEventListener("click", runCheck);
            document.getElementById("grammarDemoBtn").addEventListener("click", () => { input.value = "hi i wrote this  text  but it isnt looking good!! can you fix it"; runCheck(); });
        })();
    </script>
HTML;
}

function getParaphraseToolHTML() {
    return <<<'HTML'
    <div class="max-w-5xl mx-auto grid xl:grid-cols-[1fr_1fr] gap-6">
        <div class="rounded-[32px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 shadow-xl p-6 md:p-7 space-y-5">
            <p class="text-[11px] tracking-[0.34em] uppercase text-sky-500 font-semibold">Writing Tool</p>
            <h2 class="text-3xl font-black text-slate-900 dark:text-white">Paraphrase Tool</h2>
            <textarea id="paraphraseInput" rows="16" class="w-full rounded-3xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-4 text-slate-900 dark:text-white" placeholder="Paste your paragraph here"></textarea>
            <div class="flex flex-wrap gap-3"><button id="paraphraseBtn" class="rounded-2xl bg-sky-600 text-white px-5 py-3 font-semibold">Paraphrase Text</button><button id="paraphraseDemoBtn" class="rounded-2xl bg-slate-200 dark:bg-slate-800 text-slate-900 dark:text-white px-5 py-3 font-semibold">Load Demo</button><p id="paraphraseStatus" class="text-sm text-slate-500 dark:text-slate-400 self-center">Creates a cleaner alternative phrasing locally in the browser.</p></div>
        </div>
        <div class="rounded-[32px] border border-slate-200 dark:border-slate-800 bg-slate-950 shadow-xl p-6">
            <h3 class="text-xl font-black text-white">Paraphrased Version</h3>
            <textarea id="paraphraseOutput" rows="18" class="mt-4 w-full rounded-3xl bg-slate-900 border border-white/10 px-4 py-4 text-slate-100"></textarea>
            <div class="mt-4 flex flex-wrap gap-3"><button id="paraphraseCopy" class="rounded-2xl bg-white text-slate-900 px-5 py-3 font-semibold">Copy Result</button><div id="paraphraseNotes" class="text-sm text-slate-300 self-center"></div></div>
        </div>
    </div>
    <script>
        (() => {
            const input = document.getElementById("paraphraseInput"), output = document.getElementById("paraphraseOutput"), status = document.getElementById("paraphraseStatus"), notes = document.getElementById("paraphraseNotes");
            const swaps = [["in order to","to"],["due to the fact that","because"],["a lot of","many"],["helps to","helps"],["make sure","ensure"],["has the ability to","can"],["in the event that","if"],["at this point in time","now"],["utilize","use"],["prior to","before"]];
            function paraphrase() {
                let text = input.value.trim();
                if (!text) { status.textContent = "Enter some text first."; return; }
                swaps.forEach(([from, to]) => {
                    const regex = new RegExp(from, "gi");
                    text = text.replace(regex, to);
                });
                text = text.replace(/\s{2,}/g, " ").replace(/\.\s+/g, ".\n\n");
                text = text.replace(/^\s*([a-z])/m, (m, c) => c.toUpperCase());
                output.value = text;
                status.textContent = "Paraphrased version generated.";
                notes.textContent = `${swaps.length} phrase-level rewrites available in the local rule set.`;
            }
            document.getElementById("paraphraseBtn").addEventListener("click", paraphrase);
            document.getElementById("paraphraseDemoBtn").addEventListener("click", () => { input.value = "In order to improve the website, we need to utilize clearer wording and make sure the content is easier to read at this point in time."; paraphrase(); });
            document.getElementById("paraphraseCopy").addEventListener("click", async () => {
                try { await navigator.clipboard.writeText(output.value || ""); notes.textContent = "Copied."; } catch (e) { notes.textContent = "Copy failed."; }
            });
        })();
    </script>
HTML;
}

function getPercentageCalculatorHTML() {
    return <<<'HTML'
    <div class="max-w-6xl mx-auto grid xl:grid-cols-[1.05fr_0.95fr] gap-6">
        <div class="rounded-[34px] border border-amber-200/60 dark:border-amber-500/15 bg-gradient-to-br from-white via-amber-50/70 to-orange-50/60 dark:from-slate-950 dark:via-slate-950 dark:to-slate-900 shadow-[0_24px_80px_rgba(245,158,11,0.12)] p-6 md:p-8">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-[11px] tracking-[0.34em] uppercase text-amber-500 font-semibold">Calculator Suite</p>
                    <h2 class="mt-2 text-3xl font-black text-slate-900 dark:text-white">Percentage Calculator</h2>
                    <p class="mt-3 text-sm text-slate-500 dark:text-slate-400 max-w-xl">Use it for discounts, growth rates, exam scores, margins, and everyday comparisons without messy mental math.</p>
                </div>
                <div class="hidden sm:flex w-14 h-14 rounded-2xl bg-amber-500/15 text-amber-500 items-center justify-center">
                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><line x1="19" y1="5" x2="5" y2="19"/><circle cx="6.5" cy="6.5" r="2.5"/><circle cx="17.5" cy="17.5" r="2.5"/></svg>
                </div>
            </div>
            <div class="mt-6 grid sm:grid-cols-3 gap-4">
                <label class="block rounded-[28px] border border-white/60 dark:border-slate-800 bg-white/80 dark:bg-slate-950/70 p-4">
                    <span class="text-xs uppercase tracking-[0.22em] text-slate-500">Value</span>
                    <input id="percentValue" type="number" class="mt-3 w-full rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-4 text-lg font-semibold text-slate-900 dark:text-white" value="25">
                </label>
                <label class="block rounded-[28px] border border-white/60 dark:border-slate-800 bg-white/80 dark:bg-slate-950/70 p-4">
                    <span class="text-xs uppercase tracking-[0.22em] text-slate-500">% Of</span>
                    <input id="percentBase" type="number" class="mt-3 w-full rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-4 text-lg font-semibold text-slate-900 dark:text-white" value="200">
                </label>
                <div class="flex items-stretch">
                    <button id="percentCalcBtn" class="w-full rounded-[28px] bg-gradient-to-r from-amber-500 to-orange-500 text-slate-950 px-5 py-4 font-semibold shadow-[0_20px_45px_rgba(245,158,11,0.28)]">Calculate Percentage</button>
                </div>
            </div>
            <div class="mt-5 flex flex-wrap gap-2" id="percentPresets">
                <button type="button" data-value="25" data-base="200" class="rounded-full bg-white/85 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 px-4 py-2 text-sm text-slate-700 dark:text-slate-200">25 of 200</button>
                <button type="button" data-value="15" data-base="60" class="rounded-full bg-white/85 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 px-4 py-2 text-sm text-slate-700 dark:text-slate-200">15 of 60</button>
                <button type="button" data-value="320" data-base="500" class="rounded-full bg-white/85 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 px-4 py-2 text-sm text-slate-700 dark:text-slate-200">320 of 500</button>
            </div>
        </div>
        <div class="grid gap-6">
            <div class="rounded-[34px] border border-slate-200 dark:border-slate-800 bg-slate-950 shadow-[0_24px_80px_rgba(15,23,42,0.35)] p-6 text-white">
                <p class="text-xs uppercase tracking-[0.22em] text-amber-300">Result</p>
                <div id="percentResult" class="mt-4 text-6xl font-black tracking-tight">0%</div>
                <p id="percentMeta" class="mt-3 text-sm leading-6 text-slate-300">25 is what percent of 200?</p>
            </div>
            <div class="grid sm:grid-cols-2 gap-4">
                <div class="rounded-[28px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 p-5">
                    <p class="text-xs uppercase tracking-[0.22em] text-slate-500">Quick Tip</p>
                    <p class="mt-3 text-sm text-slate-600 dark:text-slate-300">Use this for sale discounts, attendance percentages, and profit margin snapshots.</p>
                </div>
                <div class="rounded-[28px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 p-5">
                    <p class="text-xs uppercase tracking-[0.22em] text-slate-500">Formula</p>
                    <p class="mt-3 text-sm text-slate-600 dark:text-slate-300"><strong class="text-slate-900 dark:text-white">Value / Base � 100</strong></p>
                </div>
            </div>
        </div>
    </div>
    <script>(() => { const valueInput = document.getElementById("percentValue"); const baseInput = document.getElementById("percentBase"); const resultEl = document.getElementById("percentResult"); const metaEl = document.getElementById("percentMeta"); const calc = () => { const value = parseFloat(valueInput.value) || 0; const base = parseFloat(baseInput.value) || 0; const result = base === 0 ? 0 : (value / base) * 100; resultEl.textContent = `${result.toFixed(2)}%`; metaEl.textContent = `${value} is ${result.toFixed(2)}% of ${base}.`; }; document.getElementById("percentCalcBtn").addEventListener("click", calc); [valueInput, baseInput].forEach((el) => el.addEventListener("input", calc)); document.querySelectorAll("#percentPresets [data-value]").forEach((btn) => btn.addEventListener("click", () => { valueInput.value = btn.dataset.value; baseInput.value = btn.dataset.base; calc(); })); calc(); })();</script>
HTML;
}

function getLoanCalculatorHTML() {
    return <<<'HTML'
    <div class="max-w-6xl mx-auto grid xl:grid-cols-[1.08fr_0.92fr] gap-6">
        <div class="rounded-[34px] border border-emerald-200/60 dark:border-emerald-500/15 bg-gradient-to-br from-white via-emerald-50/70 to-teal-50/60 dark:from-slate-950 dark:via-slate-950 dark:to-slate-900 shadow-[0_24px_80px_rgba(16,185,129,0.12)] p-6 md:p-8">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-[11px] tracking-[0.34em] uppercase text-emerald-500 font-semibold">Calculator Suite</p>
                    <h2 class="mt-2 text-3xl font-black text-slate-900 dark:text-white">Loan EMI Calculator</h2>
                    <p class="mt-3 text-sm text-slate-500 dark:text-slate-400 max-w-xl">Estimate monthly payments, interest cost, and total repayment with a cleaner finance-style layout.</p>
                </div>
                <div class="hidden sm:flex w-14 h-14 rounded-2xl bg-emerald-500/15 text-emerald-500 items-center justify-center">
                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M7 10h10"/><path d="M7 14h5"/></svg>
                </div>
            </div>
            <div class="mt-6 grid md:grid-cols-3 gap-4">
                <label class="block rounded-[28px] border border-white/60 dark:border-slate-800 bg-white/80 dark:bg-slate-950/70 p-4"><span class="text-xs uppercase tracking-[0.22em] text-slate-500">Loan Amount</span><input id="loanAmount" type="number" class="mt-3 w-full rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-4 text-lg font-semibold text-slate-900 dark:text-white" value="500000"></label>
                <label class="block rounded-[28px] border border-white/60 dark:border-slate-800 bg-white/80 dark:bg-slate-950/70 p-4"><span class="text-xs uppercase tracking-[0.22em] text-slate-500">Annual Rate %</span><input id="loanRate" type="number" step="0.1" class="mt-3 w-full rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-4 text-lg font-semibold text-slate-900 dark:text-white" value="14"></label>
                <label class="block rounded-[28px] border border-white/60 dark:border-slate-800 bg-white/80 dark:bg-slate-950/70 p-4"><span class="text-xs uppercase tracking-[0.22em] text-slate-500">Months</span><input id="loanMonths" type="number" class="mt-3 w-full rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-4 text-lg font-semibold text-slate-900 dark:text-white" value="36"></label>
            </div>
            <div class="mt-5 flex flex-wrap gap-2" id="loanPresets">
                <button type="button" data-amount="300000" data-rate="12" data-months="24" class="rounded-full bg-white/85 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 px-4 py-2 text-sm text-slate-700 dark:text-slate-200">Small loan</button>
                <button type="button" data-amount="1000000" data-rate="14" data-months="48" class="rounded-full bg-white/85 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 px-4 py-2 text-sm text-slate-700 dark:text-slate-200">Business loan</button>
                <button type="button" data-amount="2500000" data-rate="11.5" data-months="60" class="rounded-full bg-white/85 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 px-4 py-2 text-sm text-slate-700 dark:text-slate-200">Long term</button>
            </div>
            <button id="loanCalcBtn" class="mt-6 rounded-[28px] bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-6 py-4 font-semibold shadow-[0_20px_45px_rgba(16,185,129,0.28)]">Calculate EMI</button>
        </div>
        <div class="grid gap-4">
            <div class="rounded-[34px] border border-slate-200 dark:border-slate-800 bg-slate-950 shadow-[0_24px_80px_rgba(15,23,42,0.35)] p-6 text-white">
                <p class="text-xs uppercase tracking-[0.22em] text-emerald-300">Monthly EMI</p>
                <div id="loanEmi" class="mt-3 text-6xl font-black tracking-tight">0</div>
                <p class="mt-3 text-sm text-slate-300">Your estimated recurring monthly payment.</p>
            </div>
            <div class="grid sm:grid-cols-2 gap-4">
                <div class="rounded-[28px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 p-5">
                    <p class="text-xs uppercase tracking-[0.22em] text-slate-500">Total Payment</p>
                    <div id="loanTotal" class="mt-3 text-3xl font-black text-slate-900 dark:text-white">0</div>
                </div>
                <div class="rounded-[28px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 p-5">
                    <p class="text-xs uppercase tracking-[0.22em] text-slate-500">Total Interest</p>
                    <div id="loanInterest" class="mt-3 text-3xl font-black text-slate-900 dark:text-white">0</div>
                </div>
            </div>
        </div>
    </div>
    <script>(() => { const amountEl = document.getElementById("loanAmount"); const rateEl = document.getElementById("loanRate"); const monthsEl = document.getElementById("loanMonths"); const calc = () => { const principal = parseFloat(amountEl.value) || 0; const annualRate = parseFloat(rateEl.value) || 0; const months = parseFloat(monthsEl.value) || 0; const monthlyRate = annualRate / 12 / 100; const emi = monthlyRate === 0 ? principal / Math.max(months, 1) : (principal * monthlyRate * Math.pow(1 + monthlyRate, months)) / (Math.pow(1 + monthlyRate, months) - 1); const total = emi * months; const interest = total - principal; document.getElementById("loanEmi").textContent = emi.toFixed(2); document.getElementById("loanTotal").textContent = total.toFixed(2); document.getElementById("loanInterest").textContent = interest.toFixed(2); }; document.getElementById("loanCalcBtn").addEventListener("click", calc); [amountEl, rateEl, monthsEl].forEach((el) => el.addEventListener("input", calc)); document.querySelectorAll("#loanPresets [data-amount]").forEach((btn) => btn.addEventListener("click", () => { amountEl.value = btn.dataset.amount; rateEl.value = btn.dataset.rate; monthsEl.value = btn.dataset.months; calc(); })); calc(); })();</script>
HTML;
}

function getBmiCalculatorHTML() {
    return <<<'HTML'
    <div class="max-w-6xl mx-auto grid xl:grid-cols-[1.06fr_0.94fr] gap-6">
        <div class="rounded-[34px] border border-rose-200/60 dark:border-rose-500/15 bg-gradient-to-br from-white via-rose-50/70 to-pink-50/60 dark:from-slate-950 dark:via-slate-950 dark:to-slate-900 shadow-[0_24px_80px_rgba(244,63,94,0.12)] p-6 md:p-8">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-[11px] tracking-[0.34em] uppercase text-rose-500 font-semibold">Calculator Suite</p>
                    <h2 class="mt-2 text-3xl font-black text-slate-900 dark:text-white">BMI Calculator</h2>
                    <p class="mt-3 text-sm text-slate-500 dark:text-slate-400 max-w-xl">Check body mass index with multiple unit options and a cleaner health-focused layout.</p>
                </div>
                <div class="hidden sm:flex w-14 h-14 rounded-2xl bg-rose-500/15 text-rose-500 items-center justify-center">
                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="M12 3v18"/><path d="M8 7h8"/><path d="M8 12h8"/><path d="M8 17h8"/></svg>
                </div>
            </div>
            <div class="mt-6 grid gap-4">
                <div class="grid md:grid-cols-[1fr_190px] gap-4">
                    <label class="block">
                        <span class="text-xs uppercase tracking-[0.22em] text-slate-500">Weight</span>
                        <input id="bmiWeight" type="number" step="0.1" class="mt-3 w-full rounded-[24px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-900 px-4 py-4 text-lg font-semibold text-slate-900 dark:text-white" value="70">
                    </label>
                    <label class="block">
                        <span class="text-xs uppercase tracking-[0.22em] text-slate-500">Weight Unit</span>
                        <select id="bmiWeightUnit" class="mt-3 w-full rounded-[24px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-900 px-4 py-4 text-base font-semibold text-slate-900 dark:text-white">
                            <option value="kg">Kilograms (kg)</option>
                            <option value="lb">Pounds (lb)</option>
                        </select>
                    </label>
                </div>
                <div class="grid md:grid-cols-[1fr_190px] gap-4">
                    <label class="block">
                        <span class="text-xs uppercase tracking-[0.22em] text-slate-500">Height</span>
                        <input id="bmiHeight" type="number" step="0.1" class="mt-3 w-full rounded-[24px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-900 px-4 py-4 text-lg font-semibold text-slate-900 dark:text-white" value="175">
                    </label>
                    <label class="block">
                        <span class="text-xs uppercase tracking-[0.22em] text-slate-500">Height Unit</span>
                        <select id="bmiHeightUnit" class="mt-3 w-full rounded-[24px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-900 px-4 py-4 text-base font-semibold text-slate-900 dark:text-white">
                            <option value="cm">Centimeters (cm)</option>
                            <option value="m">Meters (m)</option>
                            <option value="ftin">Feet + Inches</option>
                            <option value="in">Inches (in)</option>
                        </select>
                    </label>
                </div>
                <div id="bmiFeetInchesWrap" class="hidden grid md:grid-cols-2 gap-4">
                    <label class="block">
                        <span class="text-xs uppercase tracking-[0.22em] text-slate-500">Feet</span>
                        <input id="bmiFeet" type="number" step="1" class="mt-3 w-full rounded-[24px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-900 px-4 py-4 text-lg font-semibold text-slate-900 dark:text-white" value="5">
                    </label>
                    <label class="block">
                        <span class="text-xs uppercase tracking-[0.22em] text-slate-500">Inches</span>
                        <input id="bmiInches" type="number" step="0.1" class="mt-3 w-full rounded-[24px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-900 px-4 py-4 text-lg font-semibold text-slate-900 dark:text-white" value="9">
                    </label>
                </div>
                <div class="flex flex-wrap gap-2" id="bmiPresets">
                    <button type="button" data-weight="70" data-weight-unit="kg" data-height="175" data-height-unit="cm" class="rounded-full bg-white/85 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 px-4 py-2 text-sm text-slate-700 dark:text-slate-200">Metric</button>
                    <button type="button" data-weight="154" data-weight-unit="lb" data-height-unit="ftin" data-feet="5" data-inches="9" class="rounded-full bg-white/85 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 px-4 py-2 text-sm text-slate-700 dark:text-slate-200">Imperial</button>
                    <button type="button" data-weight="82" data-weight-unit="kg" data-height="1.78" data-height-unit="m" class="rounded-full bg-white/85 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 px-4 py-2 text-sm text-slate-700 dark:text-slate-200">Meters</button>
                </div>
                <button id="bmiCalcBtn" class="rounded-[28px] bg-gradient-to-r from-rose-500 to-pink-500 text-white px-6 py-4 font-semibold shadow-[0_20px_45px_rgba(244,63,94,0.28)]">Calculate BMI</button>
            </div>
        </div>
        <div class="grid gap-4">
            <div class="rounded-[34px] border border-slate-200 dark:border-slate-800 bg-slate-950 shadow-[0_24px_80px_rgba(15,23,42,0.35)] p-6 text-white">
                <p class="text-xs uppercase tracking-[0.22em] text-rose-300">Body Mass Index</p>
                <div id="bmiResult" class="mt-4 text-6xl font-black tracking-tight">0</div>
                <p id="bmiCategory" class="mt-3 text-xl text-slate-200">Category will appear here.</p>
                <p id="bmiMeta" class="mt-3 text-sm leading-6 text-slate-400">Supports kg, lb, cm, m, feet/inches, and inches.</p>
            </div>
            <div class="grid sm:grid-cols-3 gap-4">
                <div class="rounded-[28px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 p-5">
                    <p class="text-xs uppercase tracking-[0.22em] text-slate-500">Range</p>
                    <p class="mt-3 text-sm text-slate-600 dark:text-slate-300">Normal BMI is usually between 18.5 and 24.9.</p>
                </div>
                <div class="rounded-[28px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 p-5">
                    <p class="text-xs uppercase tracking-[0.22em] text-slate-500">Use Case</p>
                    <p class="mt-3 text-sm text-slate-600 dark:text-slate-300">Useful for quick health estimates, not a diagnosis.</p>
                </div>
                <div class="rounded-[28px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 p-5">
                    <p class="text-xs uppercase tracking-[0.22em] text-slate-500">Units</p>
                    <p class="mt-3 text-sm text-slate-600 dark:text-slate-300">Metric and imperial inputs are both supported.</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        (() => {
            const weightInput = document.getElementById("bmiWeight");
            const weightUnit = document.getElementById("bmiWeightUnit");
            const heightInput = document.getElementById("bmiHeight");
            const heightUnit = document.getElementById("bmiHeightUnit");
            const feetWrap = document.getElementById("bmiFeetInchesWrap");
            const feetInput = document.getElementById("bmiFeet");
            const inchesInput = document.getElementById("bmiInches");
            const resultEl = document.getElementById("bmiResult");
            const categoryEl = document.getElementById("bmiCategory");
            const metaEl = document.getElementById("bmiMeta");

            function syncHeightFields() {
                const useFeet = heightUnit.value === "ftin";
                feetWrap.classList.toggle("hidden", !useFeet);
                heightInput.parentElement.classList.toggle("hidden", useFeet);
            }

            function getWeightKg() {
                const value = parseFloat(weightInput.value) || 0;
                return weightUnit.value === "lb" ? value * 0.45359237 : value;
            }

            function getHeightMeters() {
                const value = parseFloat(heightInput.value) || 0;
                switch (heightUnit.value) {
                    case "m":
                        return value;
                    case "in":
                        return value * 0.0254;
                    case "ftin":
                        return ((parseFloat(feetInput.value) || 0) * 12 + (parseFloat(inchesInput.value) || 0)) * 0.0254;
                    case "cm":
                    default:
                        return value / 100;
                }
            }

            function calc() {
                const weightKg = getWeightKg();
                const heightM = getHeightMeters();
                const bmi = heightM ? weightKg / (heightM * heightM) : 0;
                let label = "Underweight";
                if (bmi >= 30) label = "Obesity";
                else if (bmi >= 25) label = "Overweight";
                else if (bmi >= 18.5) label = "Normal";
                resultEl.textContent = bmi.toFixed(1);
                categoryEl.textContent = label;
                metaEl.textContent = `Calculated using ${weightKg.toFixed(1)} kg and ${heightM.toFixed(2)} m.`;
            }

            heightUnit.addEventListener("change", () => {
                syncHeightFields();
                calc();
            });
            [weightInput, weightUnit, heightInput, feetInput, inchesInput].forEach((el) => el.addEventListener("input", calc));
            document.querySelectorAll("#bmiPresets [data-weight]").forEach((btn) => btn.addEventListener("click", () => {
                weightInput.value = btn.dataset.weight || weightInput.value;
                weightUnit.value = btn.dataset.weightUnit || weightUnit.value;
                heightUnit.value = btn.dataset.heightUnit || heightUnit.value;
                heightInput.value = btn.dataset.height || heightInput.value;
                feetInput.value = btn.dataset.feet || feetInput.value;
                inchesInput.value = btn.dataset.inches || inchesInput.value;
                syncHeightFields();
                calc();
            }));
            document.getElementById("bmiCalcBtn").addEventListener("click", calc);
            syncHeightFields();
            calc();
        })();
    </script>
HTML;
}

function getAgeCalculatorHTML() {
    return <<<'HTML'
    <div class="max-w-6xl mx-auto grid xl:grid-cols-[1.02fr_0.98fr] gap-6">
        <div class="rounded-[34px] border border-indigo-200/60 dark:border-indigo-500/15 bg-gradient-to-br from-white via-indigo-50/70 to-sky-50/60 dark:from-slate-950 dark:via-slate-950 dark:to-slate-900 shadow-[0_24px_80px_rgba(99,102,241,0.12)] p-6 md:p-8">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-[11px] tracking-[0.34em] uppercase text-indigo-500 font-semibold">Calculator Suite</p>
                    <h2 class="mt-2 text-3xl font-black text-slate-900 dark:text-white">Age Calculator</h2>
                    <p class="mt-3 text-sm text-slate-500 dark:text-slate-400 max-w-xl">Check current age from date of birth with a cleaner result layout for forms, records, and quick calculations.</p>
                </div>
                <div class="hidden sm:flex w-14 h-14 rounded-2xl bg-indigo-500/15 text-indigo-500 items-center justify-center">
                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4"/><path d="M8 3v4"/><path d="M3 10h18"/></svg>
                </div>
            </div>
            <div class="mt-6 grid gap-4">
                <label class="block rounded-[28px] border border-white/60 dark:border-slate-800 bg-white/80 dark:bg-slate-950/70 p-4">
                    <span class="text-xs uppercase tracking-[0.22em] text-slate-500">Date of Birth</span>
                    <input id="ageDob" type="date" class="mt-3 w-full rounded-[24px] border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-4 text-lg font-semibold text-slate-900 dark:text-white">
                </label>
                <div class="flex flex-wrap gap-2" id="agePresets">
                    <button type="button" data-date="2000-01-01" class="rounded-full bg-white/85 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 px-4 py-2 text-sm text-slate-700 dark:text-slate-200">2000-01-01</button>
                    <button type="button" data-date="1995-08-17" class="rounded-full bg-white/85 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 px-4 py-2 text-sm text-slate-700 dark:text-slate-200">1995-08-17</button>
                    <button type="button" data-date="2010-06-10" class="rounded-full bg-white/85 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 px-4 py-2 text-sm text-slate-700 dark:text-slate-200">2010-06-10</button>
                </div>
                <button id="ageCalcBtn" class="rounded-[28px] bg-gradient-to-r from-indigo-500 to-sky-500 text-white px-6 py-4 font-semibold shadow-[0_20px_45px_rgba(99,102,241,0.28)]">Calculate Age</button>
            </div>
        </div>
        <div class="grid gap-4">
            <div class="rounded-[34px] border border-slate-200 dark:border-slate-800 bg-slate-950 shadow-[0_24px_80px_rgba(15,23,42,0.35)] p-6 text-white">
                <p class="text-xs uppercase tracking-[0.22em] text-indigo-300">Current Age</p>
                <div id="ageYears" class="mt-4 text-6xl font-black tracking-tight">0 years</div>
                <p id="ageMeta" class="mt-3 text-lg text-slate-300">Select a birth date.</p>
            </div>
            <div class="grid sm:grid-cols-2 gap-4">
                <div class="rounded-[28px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 p-5">
                    <p class="text-xs uppercase tracking-[0.22em] text-slate-500">Useful For</p>
                    <p class="mt-3 text-sm text-slate-600 dark:text-slate-300">Admissions, HR forms, profile onboarding, and quick record checks.</p>
                </div>
                <div class="rounded-[28px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 p-5">
                    <p class="text-xs uppercase tracking-[0.22em] text-slate-500">Output</p>
                    <p class="mt-3 text-sm text-slate-600 dark:text-slate-300">Shows completed years plus months since the last birthday.</p>
                </div>
            </div>
        </div>
    </div>
    <script>(() => { const dobInput = document.getElementById("ageDob"); const calc = () => { const value = dobInput.value; if (!value) return; const dob = new Date(value), now = new Date(); let years = now.getFullYear() - dob.getFullYear(), months = now.getMonth() - dob.getMonth(); if (months < 0 || (months === 0 && now.getDate() < dob.getDate())) { years--; months += 12; } document.getElementById("ageYears").textContent = `${years} years`; document.getElementById("ageMeta").textContent = `${months} months since last birthday.`; }; document.getElementById("ageCalcBtn").addEventListener("click", calc); dobInput.addEventListener("input", calc); document.querySelectorAll("#agePresets [data-date]").forEach((btn) => btn.addEventListener("click", () => { dobInput.value = btn.dataset.date; calc(); })); })();</script>
HTML;
}

function getSensitivityConverterHTML() {
    return <<<'HTML'
    <div class="max-w-6xl mx-auto grid xl:grid-cols-[1.05fr_0.95fr] gap-6">
        <div class="rounded-[34px] border border-cyan-200/60 dark:border-cyan-500/15 bg-gradient-to-br from-white via-cyan-50/70 to-sky-50/60 dark:from-slate-950 dark:via-slate-950 dark:to-slate-900 shadow-[0_24px_80px_rgba(6,182,212,0.12)] p-6 md:p-8">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-[11px] tracking-[0.34em] uppercase text-cyan-500 font-semibold">Gaming Tools</p>
                    <h2 class="mt-2 text-3xl font-black text-slate-900 dark:text-white">Sensitivity Converter</h2>
                    <p class="mt-3 text-sm text-slate-500 dark:text-slate-400 max-w-xl">Convert mouse sensitivity between shooter titles, then optionally compare stretched-resolution visual feel for setups like 4:3 stretched versus native 16:9.</p>
                </div>
                <div class="hidden sm:flex w-14 h-14 rounded-2xl bg-cyan-500/15 text-cyan-500 items-center justify-center">
                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="M12 2v20"/><path d="M8 6h8"/><path d="M8 18h8"/><path d="M10 10h4"/><path d="M10 14h4"/></svg>
                </div>
            </div>
            <div class="mt-6 grid md:grid-cols-2 gap-4">
                <label class="block rounded-[28px] border border-white/60 dark:border-slate-800 bg-white/80 dark:bg-slate-950/70 p-4">
                    <span class="text-[11px] uppercase tracking-[0.22em] text-slate-500">From Game</span>
                    <select id="sensFromGame" class="mt-3 w-full appearance-none rounded-[24px] border border-cyan-200/70 dark:border-slate-800 bg-gradient-to-b from-white to-cyan-50/70 dark:from-slate-900 dark:to-slate-950 px-5 py-4 text-base font-semibold text-slate-900 shadow-sm dark:text-white"></select>
                </label>
                <label class="block rounded-[28px] border border-white/60 dark:border-slate-800 bg-white/80 dark:bg-slate-950/70 p-4">
                    <span class="text-[11px] uppercase tracking-[0.22em] text-slate-500">To Game</span>
                    <select id="sensToGame" class="mt-3 w-full appearance-none rounded-[24px] border border-cyan-200/70 dark:border-slate-800 bg-gradient-to-b from-white to-cyan-50/70 dark:from-slate-900 dark:to-slate-950 px-5 py-4 text-base font-semibold text-slate-900 shadow-sm dark:text-white"></select>
                </label>
            </div>
            <div class="mt-4 grid md:grid-cols-3 gap-4">
                <label class="block rounded-[28px] border border-white/60 dark:border-slate-800 bg-white/80 dark:bg-slate-950/70 p-4"><span class="text-[11px] uppercase tracking-[0.22em] text-slate-500">Mouse DPI</span><input id="sensDpi" type="number" step="1" class="mt-3 w-full rounded-[24px] border border-cyan-200/70 dark:border-slate-800 bg-gradient-to-b from-white to-cyan-50/70 dark:from-slate-900 dark:to-slate-950 px-5 py-4 text-xl font-black text-slate-900 shadow-sm dark:text-white" value="800"></label>
                <label class="block rounded-[28px] border border-white/60 dark:border-slate-800 bg-white/80 dark:bg-slate-950/70 p-4"><span class="text-[11px] uppercase tracking-[0.22em] text-slate-500">In-Game Sens</span><input id="sensValue" type="number" step="0.001" class="mt-3 w-full rounded-[24px] border border-cyan-200/70 dark:border-slate-800 bg-gradient-to-b from-white to-cyan-50/70 dark:from-slate-900 dark:to-slate-950 px-5 py-4 text-xl font-black text-slate-900 shadow-sm dark:text-white" value="1.000"></label>
                <label class="block rounded-[28px] border border-white/60 dark:border-slate-800 bg-white/80 dark:bg-slate-950/70 p-4"><span class="text-[11px] uppercase tracking-[0.22em] text-slate-500">Windows Mouse</span><select id="sensWindows" class="mt-3 w-full appearance-none rounded-[24px] border border-cyan-200/70 dark:border-slate-800 bg-gradient-to-b from-white to-cyan-50/70 dark:from-slate-900 dark:to-slate-950 px-5 py-4 text-base font-semibold text-slate-900 shadow-sm dark:text-white"><option value="0.1">1/11</option><option value="0.2">2/11</option><option value="0.3">3/11</option><option value="0.4">4/11</option><option value="0.5">5/11</option><option value="1" selected>6/11 Default</option><option value="1.5">7/11</option><option value="2">8/11</option><option value="2.5">9/11</option><option value="3">10/11</option><option value="3.5">11/11</option></select></label>
            </div>
            <div class="mt-5 rounded-[28px] border border-white/60 dark:border-slate-800 bg-white/80 dark:bg-slate-950/70 p-4">
                <label class="inline-flex items-center gap-3 cursor-pointer">
                    <input id="sensResolutionToggle" type="checkbox" class="h-5 w-5 rounded border border-cyan-300 text-cyan-500 focus:ring-cyan-400">
                    <span class="text-sm font-semibold text-slate-900 dark:text-white">Use optional stretched-resolution visual adjustment</span>
                </label>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Keep this off for true raw conversion only. Turn it on if you want an extra suggestion for native vs stretched screen feel.</p>
            </div>
            <div id="sensResolutionWrap" class="mt-4 hidden grid md:grid-cols-2 gap-4">
                <label class="block rounded-[28px] border border-white/60 dark:border-slate-800 bg-white/80 dark:bg-slate-950/70 p-4">
                    <span class="text-[11px] uppercase tracking-[0.22em] text-slate-500">Source Resolution Mode</span>
                    <select id="sensSourceResolution" class="mt-3 w-full appearance-none rounded-[24px] border border-cyan-200/70 dark:border-slate-800 bg-gradient-to-b from-white to-cyan-50/70 dark:from-slate-900 dark:to-slate-950 px-5 py-4 text-base font-semibold text-slate-900 shadow-sm dark:text-white">
                        <option value="1920x1080|native">1920x1080 Native 16:9</option>
                        <option value="2560x1440|native">2560x1440 Native 16:9</option>
                        <option value="1680x1050|native">1680x1050 Native 16:10</option>
                        <option value="1440x900|native">1440x900 Native 16:10</option>
                        <option value="1280x960|stretched">1280x960 Stretched 4:3</option>
                        <option value="1280x960|blackbars">1280x960 Black Bars 4:3</option>
                        <option value="1280x1024|stretched">1280x1024 Stretched 5:4</option>
                        <option value="1440x1080|stretched">1440x1080 Stretched 4:3</option>
                        <option value="1600x1200|stretched">1600x1200 Stretched 4:3</option>
                        <option value="1152x864|stretched">1152x864 Stretched 4:3</option>
                        <option value="1024x768|stretched">1024x768 Stretched 4:3</option>
                    </select>
                </label>
                <label class="block rounded-[28px] border border-white/60 dark:border-slate-800 bg-white/80 dark:bg-slate-950/70 p-4">
                    <span class="text-[11px] uppercase tracking-[0.22em] text-slate-500">Target Resolution Mode</span>
                    <select id="sensTargetResolution" class="mt-3 w-full appearance-none rounded-[24px] border border-cyan-200/70 dark:border-slate-800 bg-gradient-to-b from-white to-cyan-50/70 dark:from-slate-900 dark:to-slate-950 px-5 py-4 text-base font-semibold text-slate-900 shadow-sm dark:text-white">
                        <option value="1920x1080|native">1920x1080 Native 16:9</option>
                        <option value="2560x1440|native">2560x1440 Native 16:9</option>
                        <option value="1680x1050|native">1680x1050 Native 16:10</option>
                        <option value="1440x900|native">1440x900 Native 16:10</option>
                        <option value="1280x960|stretched">1280x960 Stretched 4:3</option>
                        <option value="1280x960|blackbars">1280x960 Black Bars 4:3</option>
                        <option value="1280x1024|stretched">1280x1024 Stretched 5:4</option>
                        <option value="1440x1080|stretched">1440x1080 Stretched 4:3</option>
                        <option value="1600x1200|stretched">1600x1200 Stretched 4:3</option>
                        <option value="1152x864|stretched">1152x864 Stretched 4:3</option>
                        <option value="1024x768|stretched">1024x768 Stretched 4:3</option>
                    </select>
                </label>
            </div>
            <div class="mt-5 flex flex-wrap gap-2" id="sensPresets">
                <button type="button" data-from="Valorant" data-to="CS2" data-value="0.35" data-dpi="800" data-win="1" data-srcres="1920x1080|native" data-tgtres="1280x960|stretched" class="rounded-full bg-white/85 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 px-4 py-2 text-sm text-slate-700 dark:text-slate-200">Val 16:9 to CS2 4:3</button>
                <button type="button" data-from="Fortnite" data-to="Apex Legends" data-value="8.00" data-dpi="1600" data-win="1" data-srcres="1920x1080|native" data-tgtres="1920x1080|native" class="rounded-full bg-white/85 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 px-4 py-2 text-sm text-slate-700 dark:text-slate-200">Fortnite to Apex</button>
                <button type="button" data-from="CS2" data-to="Valorant" data-value="1.10" data-dpi="800" data-win="1" data-srcres="1280x960|stretched" data-tgtres="1920x1080|native" class="rounded-full bg-white/85 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 px-4 py-2 text-sm text-slate-700 dark:text-slate-200">CS2 4:3 to Val</button>
            </div>
        </div>
        <div class="grid gap-4">
            <div class="rounded-[34px] border border-slate-200/80 dark:border-slate-800 bg-white/92 dark:bg-slate-950 shadow-[0_24px_80px_rgba(15,23,42,0.14)] dark:shadow-[0_24px_80px_rgba(15,23,42,0.35)] p-6 text-slate-900 dark:text-white">
                <p class="text-xs uppercase tracking-[0.22em] text-cyan-500 dark:text-cyan-300">True Engine Sensitivity</p>
                <div id="sensResult" class="mt-4 text-6xl font-black tracking-tight">0.000</div>
                <p id="sensMeta" class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-300">Choose your source and target game to convert sensitivity.</p>
            </div>
            <div class="grid sm:grid-cols-2 gap-4">
                <div class="rounded-[28px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 p-5"><p class="text-xs uppercase tracking-[0.22em] text-slate-500">eDPI</p><p id="sensEdpi" class="mt-3 text-3xl font-black text-slate-900 dark:text-white">0</p></div>
                <div class="rounded-[28px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 p-5"><p class="text-xs uppercase tracking-[0.22em] text-slate-500">Windows Factor</p><p id="sensWinMeta" class="mt-3 text-3xl font-black text-slate-900 dark:text-white">6/11</p></div>
            </div>
            <div id="sensVisualCard" class="hidden rounded-[34px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 p-6">
                <p class="text-xs uppercase tracking-[0.22em] text-slate-500">Visual Match Suggestion</p>
                <div id="sensVisualResult" class="mt-3 text-4xl font-black text-slate-900 dark:text-white">0.000</div>
                <p id="sensVisualMeta" class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-300">This optional suggestion adjusts for perceived horizontal feel when switching between native and stretched resolutions.</p>
            </div>
        </div>
    </div>
    <script>
        (() => {
            const ratios = { "Valorant": 1, "CS2": 3.181818, "Fortnite": 22.0, "Apex Legends": 3.333333, "Overwatch 2": 10.606061, "Call of Duty": 8.0 };
            const fromEl = document.getElementById("sensFromGame"), toEl = document.getElementById("sensToGame"), valueEl = document.getElementById("sensValue"), dpiEl = document.getElementById("sensDpi"), winEl = document.getElementById("sensWindows"), resolutionToggleEl = document.getElementById("sensResolutionToggle"), resolutionWrapEl = document.getElementById("sensResolutionWrap"), visualCardEl = document.getElementById("sensVisualCard"), sourceResEl = document.getElementById("sensSourceResolution"), targetResEl = document.getElementById("sensTargetResolution"), resultEl = document.getElementById("sensResult"), metaEl = document.getElementById("sensMeta"), edpiEl = document.getElementById("sensEdpi"), winMetaEl = document.getElementById("sensWinMeta"), visualResultEl = document.getElementById("sensVisualResult"), visualMetaEl = document.getElementById("sensVisualMeta");
            Object.keys(ratios).forEach((game) => {
                fromEl.appendChild(new Option(game, game));
                toEl.appendChild(new Option(game, game));
            });
            fromEl.value = "Valorant";
            toEl.value = "CS2";
            targetResEl.value = "1280x960|stretched";
            function syncResolutionUI() {
                const enabled = resolutionToggleEl.checked;
                resolutionWrapEl.classList.toggle("hidden", !enabled);
                visualCardEl.classList.toggle("hidden", !enabled);
            }
            function parseResolution(value) {
                const [res, mode] = String(value || "").split("|");
                const parts = String(res || "1920x1080").split("x").map(Number);
                return { width: parts[0] || 1920, height: parts[1] || 1080, mode: mode || "native" };
            }
            function getVisualFactor(setting) {
                const displayAspect = 16 / 9;
                const gameAspect = setting.width / setting.height;
                if (setting.mode !== "stretched") return 1;
                return displayAspect / gameAspect;
            }
            function calc() {
                const val = parseFloat(valueEl.value) || 0;
                const dpi = parseFloat(dpiEl.value) || 0;
                const windowsFactor = parseFloat(winEl.value) || 1;
                const rawSens = val;
                const converted = rawSens * (ratios[toEl.value] / ratios[fromEl.value]);
                const edpi = dpi * rawSens * windowsFactor;
                const srcRes = parseResolution(sourceResEl.value);
                const tgtRes = parseResolution(targetResEl.value);
                const srcVisualFactor = getVisualFactor(srcRes);
                const tgtVisualFactor = getVisualFactor(tgtRes);
                const visualAdjusted = tgtVisualFactor ? converted * (srcVisualFactor / tgtVisualFactor) : converted;
                resultEl.textContent = converted.toFixed(3);
                edpiEl.textContent = edpi.toFixed(1);
                winMetaEl.textContent = winEl.options[winEl.selectedIndex].textContent.replace(" Default", "");
                metaEl.textContent = `${val.toFixed(3)} sens in ${fromEl.value} converts to about ${converted.toFixed(3)} in ${toEl.value}. DPI and Windows speed affect your eDPI feel, but the cross-game conversion itself is based on the in-game engine ratio.`;
                if (resolutionToggleEl.checked) {
                    visualResultEl.textContent = visualAdjusted.toFixed(3);
                    if (srcVisualFactor === tgtVisualFactor) {
                        visualMetaEl.textContent = "Source and target resolution modes have the same visual stretch feel, so the optional visual-match suggestion stays the same.";
                    } else {
                        const diff = ((tgtVisualFactor / srcVisualFactor) - 1) * 100;
                        visualMetaEl.textContent = `Target mode changes perceived horizontal feel by ${diff >= 0 ? "+" : ""}${diff.toFixed(1)}%. The visual-match suggestion adjusts for that stretched-screen feel.`;
                    }
                }
            }
            [fromEl, toEl, valueEl, dpiEl, winEl, sourceResEl, targetResEl].forEach((el) => el.addEventListener("input", calc));
            resolutionToggleEl.addEventListener("change", () => { syncResolutionUI(); calc(); });
            document.querySelectorAll("#sensPresets [data-from]").forEach((btn) => btn.addEventListener("click", () => { fromEl.value = btn.dataset.from; toEl.value = btn.dataset.to; valueEl.value = btn.dataset.value; dpiEl.value = btn.dataset.dpi; winEl.value = btn.dataset.win; sourceResEl.value = btn.dataset.srcres; targetResEl.value = btn.dataset.tgtres; if (btn.dataset.srcres || btn.dataset.tgtres) resolutionToggleEl.checked = true; syncResolutionUI(); calc(); }));
            syncResolutionUI();
            calc();
        })();
    </script>
HTML;
}

function getReactionTimeTestHTML() {
    return <<<'HTML'
    <div class="max-w-5xl mx-auto grid xl:grid-cols-[1fr_0.95fr] gap-6">
        <div class="rounded-[34px] border border-lime-200/60 dark:border-lime-500/15 bg-gradient-to-br from-white via-lime-50/70 to-emerald-50/60 dark:from-slate-950 dark:via-slate-950 dark:to-slate-900 shadow-[0_24px_80px_rgba(132,204,22,0.12)] p-6 md:p-8">
            <p class="text-[11px] tracking-[0.34em] uppercase text-lime-500 font-semibold">Gaming Tools</p>
            <h2 class="mt-2 text-3xl font-black text-slate-900 dark:text-white">Reaction Time Test</h2>
            <p class="mt-3 text-sm text-slate-500 dark:text-slate-400">Wait for the panel to turn green, then click as fast as you can.</p>
            <button id="reactionStartBtn" class="mt-6 rounded-[28px] bg-gradient-to-r from-lime-500 to-emerald-500 text-slate-950 px-6 py-4 font-semibold shadow-[0_20px_45px_rgba(132,204,22,0.28)]">Start Test</button>
            <div id="reactionPad" class="mt-6 rounded-[34px] border border-slate-200 dark:border-slate-800 bg-rose-500/90 min-h-[280px] flex items-center justify-center text-center text-white text-2xl font-black select-none cursor-pointer">Click Start</div>
        </div>
        <div class="grid gap-4">
            <div class="rounded-[34px] border border-slate-200/80 dark:border-slate-800 bg-white/92 dark:bg-slate-950 shadow-[0_24px_80px_rgba(15,23,42,0.14)] dark:shadow-[0_24px_80px_rgba(15,23,42,0.35)] p-6 text-slate-900 dark:text-white">
                <p class="text-xs uppercase tracking-[0.22em] text-lime-500 dark:text-lime-300">Latest Result</p>
                <div id="reactionResult" class="mt-4 text-6xl font-black tracking-tight">0 ms</div>
                <p id="reactionMeta" class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-300">Your reaction result will appear here.</p>
            </div>
            <div class="rounded-[28px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 p-5">
                <p class="text-xs uppercase tracking-[0.22em] text-slate-500">Best Time</p>
                <p id="reactionBest" class="mt-3 text-3xl font-black text-slate-900 dark:text-white">0 ms</p>
            </div>
            <div class="rounded-[28px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 p-5">
                <div class="flex items-center justify-between gap-3">
                    <p class="text-xs uppercase tracking-[0.22em] text-slate-500">Global Leaderboard</p>
                    <span class="text-[11px] font-bold uppercase tracking-[0.18em] text-lime-500 dark:text-lime-300">Top 10</span>
                </div>
                <div id="reactionLeaderboard" class="mt-4 grid gap-3"></div>
            </div>
        </div>
    </div>
    <script>
        (() => {
            const startBtn = document.getElementById("reactionStartBtn"), pad = document.getElementById("reactionPad"), resultEl = document.getElementById("reactionResult"), metaEl = document.getElementById("reactionMeta"), bestEl = document.getElementById("reactionBest"), leaderboardEl = document.getElementById("reactionLeaderboard");
            let startTime = 0, timeout = null, best = null, state = "idle";
            function loadLeaderboard() {
                if (!window.any2convertLeaderboard) return;
                window.any2convertLeaderboard.fetch("reaction_time_test")
                    .then((data) => window.any2convertLeaderboard.render(leaderboardEl, data, {
                        emptyText: "No reaction scores yet. The first sharp click can own the board.",
                        loginText: "Log in to save your reaction time to the public leaderboard."
                    }))
                    .catch(() => {
                        leaderboardEl.innerHTML = '<div class="rounded-2xl border border-dashed border-slate-200 dark:border-slate-800 px-4 py-5 text-sm text-slate-500 dark:text-slate-400">Could not load the leaderboard right now.</div>';
                    });
            }
            function saveScore(result) {
                if (!window.any2convertLeaderboard) return;
                window.any2convertLeaderboard.save("reaction_time_test", {
                    primary_score: result,
                    score_label: `${result} ms`,
                    score_meta: "Best reaction time"
                }).then(() => loadLeaderboard()).catch(() => loadLeaderboard());
            }
            function resetPad(text, classes) {
                pad.className = `mt-6 rounded-[34px] border border-slate-200 dark:border-slate-800 min-h-[280px] flex items-center justify-center text-center text-white text-2xl font-black select-none cursor-pointer ${classes}`;
                pad.textContent = text;
            }
            function startRound() {
                clearTimeout(timeout);
                state = "waiting";
                startBtn.textContent = "Restart Test";
                resetPad("Wait for green...", "bg-amber-500");
                const delay = 1200 + Math.random() * 2200;
                timeout = setTimeout(() => {
                    startTime = performance.now();
                    state = "ready";
                    resetPad("CLICK!", "bg-emerald-500");
                }, delay);
            }
            startBtn.addEventListener("click", () => {
                startRound();
            });
            pad.addEventListener("click", () => {
                if (state === "idle" || state === "done") {
                    startRound();
                    return;
                }
                if (state === "ready") {
                    const result = Math.round(performance.now() - startTime);
                    resultEl.textContent = `${result} ms`;
                    metaEl.textContent = result < 200 ? "Excellent reflexes." : result < 260 ? "Very solid reaction speed." : "Good baseline. Keep practicing.";
                    best = best === null ? result : Math.min(best, result);
                    bestEl.textContent = `${best} ms`;
                    saveScore(result);
                    state = "done";
                    resetPad("Click Start Again", "bg-slate-900");
                } else if (state === "waiting") {
                    clearTimeout(timeout);
                    resultEl.textContent = "Too soon";
                    metaEl.textContent = "You clicked before the signal. Start again.";
                    state = "done";
                    resetPad("Too Early", "bg-rose-600");
                }
            });
            loadLeaderboard();
        })();
    </script>
HTML;
}

function getCpsTestHTML() {
    return <<<'HTML'
    <div class="max-w-5xl mx-auto grid xl:grid-cols-[1fr_0.95fr] gap-6">
        <div class="rounded-[34px] border border-fuchsia-200/60 dark:border-fuchsia-500/15 bg-gradient-to-br from-white via-fuchsia-50/70 to-pink-50/60 dark:from-slate-950 dark:via-slate-950 dark:to-slate-900 shadow-[0_24px_80px_rgba(217,70,239,0.12)] p-6 md:p-8">
            <p class="text-[11px] tracking-[0.34em] uppercase text-fuchsia-500 font-semibold">Gaming Tools</p>
            <h2 class="mt-2 text-3xl font-black text-slate-900 dark:text-white">CPS Test</h2>
            <p class="mt-3 text-sm text-slate-500 dark:text-slate-400">Click as fast as you can for 5 seconds to measure clicks per second.</p>
            <button id="cpsStartBtn" class="mt-6 rounded-[28px] bg-gradient-to-r from-fuchsia-500 to-pink-500 text-white px-6 py-4 font-semibold shadow-[0_20px_45px_rgba(217,70,239,0.28)]">Start Test</button>
            <div id="cpsPad" class="mt-6 rounded-[34px] border border-slate-200 dark:border-slate-800 bg-fuchsia-600 min-h-[280px] flex items-center justify-center text-center text-white text-2xl font-black select-none cursor-pointer">Click to Start</div>
        </div>
        <div class="grid gap-4">
            <div class="rounded-[34px] border border-slate-200/80 dark:border-slate-800 bg-white/92 dark:bg-slate-950 shadow-[0_24px_80px_rgba(15,23,42,0.14)] dark:shadow-[0_24px_80px_rgba(15,23,42,0.35)] p-6 text-slate-900 dark:text-white">
                <p class="text-xs uppercase tracking-[0.22em] text-fuchsia-500 dark:text-fuchsia-300">Clicks Per Second</p>
                <div id="cpsResult" class="mt-4 text-6xl font-black tracking-tight">0.00</div>
                <p id="cpsMeta" class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-300">Your CPS score will appear here.</p>
            </div>
            <div class="rounded-[28px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 p-5"><p class="text-xs uppercase tracking-[0.22em] text-slate-500">Total Clicks</p><p id="cpsClicks" class="mt-3 text-3xl font-black text-slate-900 dark:text-white">0</p></div>
            <div class="rounded-[28px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 p-5">
                <div class="flex items-center justify-between gap-3">
                    <p class="text-xs uppercase tracking-[0.22em] text-slate-500">Global Leaderboard</p>
                    <span class="text-[11px] font-bold uppercase tracking-[0.18em] text-fuchsia-500 dark:text-fuchsia-300">Top 10</span>
                </div>
                <div id="cpsLeaderboard" class="mt-4 grid gap-3"></div>
            </div>
        </div>
    </div>
    <script>
        (() => {
            const startBtn = document.getElementById("cpsStartBtn"), pad = document.getElementById("cpsPad"), resultEl = document.getElementById("cpsResult"), metaEl = document.getElementById("cpsMeta"), clicksEl = document.getElementById("cpsClicks"), leaderboardEl = document.getElementById("cpsLeaderboard");
            let clicks = 0, state = "idle", timer = null, lockedUntilRelease = false;
            function loadLeaderboard() {
                if (!window.any2convertLeaderboard) return;
                window.any2convertLeaderboard.fetch("cps_test")
                    .then((data) => window.any2convertLeaderboard.render(leaderboardEl, data, {
                        emptyText: "No CPS scores yet. Start clicking and claim the first spot.",
                        loginText: "Log in to save your CPS score to the public leaderboard."
                    }))
                    .catch(() => {
                        leaderboardEl.innerHTML = '<div class="rounded-2xl border border-dashed border-slate-200 dark:border-slate-800 px-4 py-5 text-sm text-slate-500 dark:text-slate-400">Could not load the leaderboard right now.</div>';
                    });
            }
            function saveScore(cps, totalClicks) {
                if (!window.any2convertLeaderboard) return;
                window.any2convertLeaderboard.save("cps_test", {
                    primary_score: cps,
                    secondary_score: totalClicks,
                    score_label: `${cps.toFixed(2)} CPS`,
                    score_meta: `${totalClicks} clicks in 5 seconds`
                }).then(() => loadLeaderboard()).catch(() => loadLeaderboard());
            }
            function reset() { clearTimeout(timer); clicks = 0; state = "idle"; lockedUntilRelease = false; clicksEl.textContent = "0"; resultEl.textContent = "0.00"; metaEl.textContent = "Your CPS score will appear here."; pad.textContent = "Click when the test starts"; startBtn.textContent = "Start Test"; }
            function startTest() {
                reset();
                state = "running";
                startBtn.textContent = "Running...";
                pad.textContent = "Click Here Fast!";
            }
            pad.addEventListener("mouseup", () => { lockedUntilRelease = false; });
            pad.addEventListener("mouseleave", () => { lockedUntilRelease = false; });
            startBtn.addEventListener("click", startTest);
            pad.addEventListener("click", () => {
                if (state === "idle" || state === "done") return;
                if (lockedUntilRelease) return;
                lockedUntilRelease = true;
                if (state === "running" && !timer) {
                    clicks = 1;
                    clicksEl.textContent = "1";
                    pad.textContent = "Keep Clicking!";
                    timer = setTimeout(() => {
                        state = "done";
                        const cps = clicks / 5;
                        resultEl.textContent = cps.toFixed(2);
                        metaEl.textContent = cps >= 8 ? "Very fast clicking speed." : cps >= 6 ? "Strong clicking speed." : "Good baseline. Practice for a higher score.";
                        saveScore(cps, clicks);
                        pad.textContent = "Finished";
                        startBtn.textContent = "Start Again";
                    }, 5000);
                    return;
                }
                if (state === "running") {
                    clicks++;
                    clicksEl.textContent = String(clicks);
                }
            });
            reset();
            loadLeaderboard();
        })();
    </script>
HTML;
}

function getGamerTagGeneratorHTML() {
    return <<<'HTML'
    <div class="max-w-5xl mx-auto grid xl:grid-cols-[1fr_0.95fr] gap-6">
        <div class="rounded-[34px] border border-violet-200/60 dark:border-violet-500/15 bg-gradient-to-br from-white via-violet-50/70 to-indigo-50/60 dark:from-slate-950 dark:via-slate-950 dark:to-slate-900 shadow-[0_24px_80px_rgba(139,92,246,0.12)] p-6 md:p-8">
            <p class="text-[11px] tracking-[0.34em] uppercase text-violet-500 font-semibold">Gaming Tools</p>
            <h2 class="mt-2 text-3xl font-black text-slate-900 dark:text-white">Gamer Tag Generator</h2>
            <div class="mt-6 grid md:grid-cols-2 gap-4">
                <label class="block rounded-[28px] border border-white/60 dark:border-slate-800 bg-white/80 dark:bg-slate-950/70 p-4"><span class="text-xs uppercase tracking-[0.22em] text-slate-500">Style</span><select id="tagStyle" class="mt-3 w-full rounded-[24px] border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-4 text-base font-semibold text-slate-900 dark:text-white"><option value="clean">Clean</option><option value="edgy">Edgy</option><option value="cute">Cute</option><option value="pro">Pro</option></select></label>
                <label class="block rounded-[28px] border border-white/60 dark:border-slate-800 bg-white/80 dark:bg-slate-950/70 p-4"><span class="text-xs uppercase tracking-[0.22em] text-slate-500">Keyword</span><input id="tagKeyword" class="mt-3 w-full rounded-[24px] border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-4 text-base font-semibold text-slate-900 dark:text-white" placeholder="shadow"></label>
            </div>
            <button id="tagGenerateBtn" class="mt-6 rounded-[28px] bg-gradient-to-r from-violet-500 to-indigo-500 text-white px-6 py-4 font-semibold shadow-[0_20px_45px_rgba(139,92,246,0.28)]">Generate Gamer Tags</button>
        </div>
        <div class="rounded-[34px] border border-slate-200/80 dark:border-slate-800 bg-white/92 dark:bg-slate-950 shadow-[0_24px_80px_rgba(15,23,42,0.14)] dark:shadow-[0_24px_80px_rgba(15,23,42,0.35)] p-6 text-slate-900 dark:text-white">
            <p class="text-xs uppercase tracking-[0.22em] text-violet-500 dark:text-violet-300">Suggestions</p>
            <div id="tagResults" class="mt-4 grid gap-3"></div>
        </div>
    </div>
    <script>
        (() => {
            const styles = {
                clean: ["Nova", "Pulse", "Drift", "Core", "Prime"],
                edgy: ["Reaper", "Venom", "Rogue", "Hex", "Void"],
                cute: ["Bunny", "Mochi", "Puff", "Neko", "Luna"],
                pro: ["Clutch", "Ace", "Focus", "Flick", "Strat"]
            };
            const endings = ["X", "TV", "FPS", "OP", "YT", "GG", "Live", "Z"];
            const results = document.getElementById("tagResults");
            function generate() {
                const style = document.getElementById("tagStyle").value;
                const keyword = (document.getElementById("tagKeyword").value || "Shadow").replace(/\s+/g, "");
                const list = Array.from({ length: 8 }, (_, i) => `${keyword}${styles[style][i % styles[style].length]}${endings[i % endings.length]}`);
                results.innerHTML = list.map((tag) => `<button class="rounded-[24px] border border-slate-200 dark:border-white/10 bg-slate-50 hover:bg-slate-100 dark:bg-white/5 dark:hover:bg-white/10 px-4 py-4 text-left font-semibold text-slate-900 dark:text-white transition" data-tag="${tag}">${tag}</button>`).join("");
                results.querySelectorAll("[data-tag]").forEach((btn) => btn.addEventListener("click", async () => {
                    try { await navigator.clipboard.writeText(btn.dataset.tag); btn.textContent = `${btn.dataset.tag} - Copied`; } catch (e) {}
                }));
            }
            document.getElementById("tagGenerateBtn").addEventListener("click", generate);
            generate();
        })();
    </script>
HTML;
}

function getClipToGifHTML() {
    return <<<'HTML'
    <div class="max-w-6xl mx-auto grid xl:grid-cols-[1fr_0.95fr] gap-6">
        <div class="rounded-[34px] border border-pink-200/60 dark:border-pink-500/15 bg-gradient-to-br from-white via-pink-50/70 to-rose-50/60 dark:from-slate-950 dark:via-slate-950 dark:to-slate-900 shadow-[0_24px_80px_rgba(236,72,153,0.12)] p-6 md:p-8">
            <p class="text-[11px] tracking-[0.34em] uppercase text-pink-500 font-semibold">Gaming Tools</p>
            <h2 class="mt-2 text-3xl font-black text-slate-900 dark:text-white">Clip to GIF</h2>
            <p class="mt-3 text-sm text-slate-500 dark:text-slate-400">Turn a short gaming clip into a GIF using local FFmpeg processing in the browser.</p>
            <input id="clipGifInput" type="file" accept="video/*" class="mt-6 block w-full rounded-[24px] border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-950/70 px-4 py-4 text-slate-900 dark:text-white">
            <div class="mt-5 grid md:grid-cols-4 gap-4">
                <label class="block"><span class="text-xs uppercase tracking-[0.22em] text-slate-500">Start (sec)</span><input id="clipGifStart" type="number" min="0" step="0.1" value="0" class="mt-3 w-full rounded-[24px] border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-950/70 px-4 py-4 text-slate-900 dark:text-white"></label>
                <label class="block"><span class="text-xs uppercase tracking-[0.22em] text-slate-500">Duration</span><input id="clipGifDuration" type="number" min="1" step="0.1" value="3" class="mt-3 w-full rounded-[24px] border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-950/70 px-4 py-4 text-slate-900 dark:text-white"></label>
                <label class="block"><span class="text-xs uppercase tracking-[0.22em] text-slate-500">FPS</span><input id="clipGifFps" type="number" min="5" max="30" step="1" value="12" class="mt-3 w-full rounded-[24px] border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-950/70 px-4 py-4 text-slate-900 dark:text-white"></label>
                <label class="block"><span class="text-xs uppercase tracking-[0.22em] text-slate-500">Width</span><input id="clipGifWidth" type="number" min="160" step="10" value="480" class="mt-3 w-full rounded-[24px] border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-950/70 px-4 py-4 text-slate-900 dark:text-white"></label>
            </div>
            <div class="mt-6 flex flex-wrap gap-3">
                <button id="clipGifRunBtn" class="rounded-[28px] bg-gradient-to-r from-pink-500 to-rose-500 text-white px-6 py-4 font-semibold shadow-[0_20px_45px_rgba(236,72,153,0.28)]">Create GIF</button>
                <button id="clipGifDownloadBtn" class="rounded-[28px] bg-slate-900 dark:bg-white text-white dark:text-slate-900 px-6 py-4 font-semibold" disabled>Download GIF</button>
                <p id="clipGifStatus" class="self-center text-sm text-slate-500 dark:text-slate-400">Upload a short clip to begin.</p>
            </div>
            <video id="clipGifPreviewVideo" class="mt-6 hidden w-full rounded-[28px] bg-black" controls preload="metadata"></video>
        </div>
        <div class="rounded-[34px] border border-slate-200 dark:border-slate-800 bg-slate-950 shadow-[0_24px_80px_rgba(15,23,42,0.35)] p-6 text-white">
            <p class="text-xs uppercase tracking-[0.22em] text-pink-300">GIF Preview</p>
            <div class="mt-4 min-h-[320px] rounded-[28px] border border-white/10 bg-white/5 flex items-center justify-center overflow-hidden">
                <img id="clipGifPreview" class="max-w-full hidden" alt="GIF preview">
                <div id="clipGifPlaceholder" class="text-slate-400 text-sm">Your generated GIF will appear here.</div>
            </div>
        </div>
    </div>
    <script src="assets/vendor/ffmpeg/ffmpeg.js"></script>
    <script src="assets/vendor/ffmpeg/util.js"></script>
    <script>
        (() => {
            const input = document.getElementById("clipGifInput");
            const runBtn = document.getElementById("clipGifRunBtn");
            const downloadBtn = document.getElementById("clipGifDownloadBtn");
            const status = document.getElementById("clipGifStatus");
            const previewVideo = document.getElementById("clipGifPreviewVideo");
            const previewImg = document.getElementById("clipGifPreview");
            const placeholder = document.getElementById("clipGifPlaceholder");
            let ffmpeg = null;
            let ffmpegLoaded = false;
            let gifUrl = "";

            function setStatus(message) { status.textContent = message; }
            function revokeGif() { if (gifUrl) { URL.revokeObjectURL(gifUrl); gifUrl = ""; } }
            async function ensureFFmpegLoaded() {
                if (ffmpegLoaded) return ffmpeg;
                const { FFmpeg } = FFmpegWASM;
                const { toBlobURL } = FFmpegUtil;
                ffmpeg = new FFmpeg();
                ffmpeg.on("log", function(event) { if (event && event.message) setStatus("Processing: " + event.message); });
                const baseURL = "https://cdn.jsdelivr.net/npm/@ffmpeg/core@0.12.6/dist/umd";
                setStatus("Loading GIF conversion engine...");
                await ffmpeg.load({
                    coreURL: await toBlobURL(baseURL + "/ffmpeg-core.js", "text/javascript"),
                    wasmURL: await toBlobURL(baseURL + "/ffmpeg-core.wasm", "application/wasm")
                });
                ffmpegLoaded = true;
                setStatus("GIF converter ready.");
                return ffmpeg;
            }

            input.addEventListener("change", () => {
                const file = input.files?.[0];
                if (!file) return;
                previewVideo.src = URL.createObjectURL(file);
                previewVideo.classList.remove("hidden");
                setStatus(`Loaded ${file.name}.`);
            });

            runBtn.addEventListener("click", async () => {
                const file = input.files?.[0];
                if (!file) { setStatus("Please select a video clip first."); return; }
                try {
                    revokeGif();
                    const engine = await ensureFFmpegLoaded();
                    const { fetchFile } = FFmpegUtil;
                    const start = parseFloat(document.getElementById("clipGifStart").value) || 0;
                    const duration = parseFloat(document.getElementById("clipGifDuration").value) || 3;
                    const fps = parseFloat(document.getElementById("clipGifFps").value) || 12;
                    const width = parseFloat(document.getElementById("clipGifWidth").value) || 480;
                    const inputName = "clip." + ((file.name.split(".").pop() || "mp4").toLowerCase());
                    await engine.writeFile(inputName, await fetchFile(file));
                    setStatus("Creating GIF...");
                    await engine.exec(["-ss", String(start), "-t", String(duration), "-i", inputName, "-vf", `fps=${fps},scale=${width}:-1:flags=lanczos`, "-loop", "0", "output.gif"]);
                    const data = await engine.readFile("output.gif");
                    const blob = new Blob([data.buffer], { type: "image/gif" });
                    gifUrl = URL.createObjectURL(blob);
                    previewImg.src = gifUrl;
                    previewImg.classList.remove("hidden");
                    placeholder.classList.add("hidden");
                    downloadBtn.disabled = false;
                    setStatus("GIF created successfully.");
                } catch (error) {
                    setStatus(error.message || "Could not create GIF.");
                }
            });

            downloadBtn.addEventListener("click", () => {
                if (!gifUrl) return;
                const a = document.createElement("a");
                a.href = gifUrl;
                a.download = "clip.gif";
                a.click();
            });
        })();
    </script>
HTML;
}

function getTournamentBracketGeneratorHTML() {
    return <<<'HTML'
    <style>
        .bq{max-width:98rem;margin:0 auto;display:grid;grid-template-columns:minmax(300px,332px) minmax(0,1fr);gap:1.15rem}
        .bq-side,.bq-board{border:1px solid rgba(148,163,184,.12);box-shadow:0 24px 80px rgba(15,23,42,.28)}
        .bq-side{border-radius:2rem;padding:1.2rem;background:linear-gradient(180deg,rgba(17,24,39,.96),rgba(15,23,42,.98));color:#f8fafc;backdrop-filter:blur(16px)}
        .bq-card{border-radius:1.4rem;padding:1rem;background:linear-gradient(180deg,rgba(255,255,255,.045),rgba(255,255,255,.025));border:1px solid rgba(255,255,255,.07);box-shadow:inset 0 1px 0 rgba(255,255,255,.03)}
        .bq-field{width:100%;margin-top:.7rem;border-radius:1rem;border:1px solid rgba(255,255,255,.08);background:linear-gradient(180deg,rgba(15,23,42,.88),rgba(15,23,42,.76));color:#f8fafc;padding:.9rem .95rem;font-weight:700;outline:none;box-shadow:inset 0 1px 0 rgba(255,255,255,.03);transition:border-color .22s ease, box-shadow .22s ease, transform .22s ease}
        .bq-field:focus{border-color:rgba(56,189,248,.42);box-shadow:0 0 0 4px rgba(56,189,248,.12), inset 0 1px 0 rgba(255,255,255,.03)}
        .bq-side textarea.bq-field{min-height:14rem;line-height:1.65}
        .bq-side button{transition:transform .22s ease, box-shadow .22s ease, border-color .22s ease, background .22s ease}
        .bq-side button:hover{transform:translateY(-1px)}
        .bq-board{border-radius:2rem;padding:1.2rem;min-height:44rem;color:#fff;background:
            radial-gradient(circle at top left,rgba(59,130,246,.1),transparent 22rem),
            radial-gradient(circle at bottom right,rgba(34,211,238,.08),transparent 20rem),
            linear-gradient(180deg,#1d2128 0%,#141821 100%)}
        .bq-board-top{display:flex;flex-wrap:wrap;align-items:flex-end;justify-content:space-between;gap:1rem;padding-bottom:1rem;border-bottom:1px solid rgba(255,255,255,.08)}
        .bq-board-head h3{line-height:1}
        .bq-board-head p{max-width:38rem}
        .bq-board-stats{display:flex;flex-wrap:wrap;gap:.75rem}
        .bq-canvas{overflow:auto;margin-top:1rem;padding:1.05rem 4.75rem 2rem 1rem;border-radius:1.6rem;border:1px solid rgba(255,255,255,.06);background:
            linear-gradient(180deg,rgba(255,255,255,.025),rgba(255,255,255,.015)),
            linear-gradient(transparent 31px,rgba(255,255,255,.03) 32px),
            linear-gradient(90deg,transparent 31px,rgba(255,255,255,.03) 32px);
            background-size:auto,32px 32px,32px 32px;
            box-shadow:inset 0 1px 0 rgba(255,255,255,.03)}
        .bq-rounds{display:flex;gap:2.1rem;align-items:flex-start;min-width:max-content;padding-right:8rem;padding-bottom:1rem}
        .bq-round{min-width:15.4rem;display:flex;flex-direction:column}
        .bq-stage{margin-bottom:1rem;padding-left:.15rem}
        .bq-match{position:relative;width:13.75rem;height:5.1rem}.bq-box{height:100%;display:grid;grid-template-rows:1fr 1fr;background:rgba(18,22,31,.98);border:1px solid rgba(255,255,255,.1);border-radius:1.05rem;overflow:hidden;position:relative;z-index:2;box-shadow:0 12px 30px rgba(2,8,23,.22)}
        .bq-row{display:grid;grid-template-columns:auto 1fr auto;gap:.55rem;align-items:center;padding:.58rem .72rem}.bq-row+.bq-row{border-top:1px solid rgba(255,255,255,.08)}
        .bq-row.win{background:linear-gradient(90deg,rgba(34,197,94,.12),transparent 85%)}.bq-row.dim .bq-name{color:rgba(148,163,184,.8);font-weight:700}
        .bq-seed,.bq-score{font-size:.8rem;font-weight:900}.bq-name{white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-size:.92rem;font-weight:800}
        .bq-pill{position:absolute;top:-.72rem;left:.7rem;z-index:3;padding:.22rem .5rem;border-radius:999px;font-size:.61rem;letter-spacing:.12em;text-transform:uppercase;background:rgba(14,165,233,.16);border:1px solid rgba(56,189,248,.18);color:#7dd3fc;font-weight:800}
        .bq-h,.bq-v{position:absolute;background:rgba(255,255,255,.72);z-index:1}.bq-h{top:calc(50% - 1px);left:calc(100% + .15rem);width:1.35rem;height:2px}.bq-v{left:calc(100% + 1.48rem);width:2px;height:var(--span)}.bq-v.down{top:50%}.bq-v.up{top:calc(50% - var(--span))}
        .bq-stat{border-radius:1.1rem;padding:.9rem 1rem;background:linear-gradient(180deg,rgba(255,255,255,.05),rgba(255,255,255,.025));border:1px solid rgba(255,255,255,.07);min-width:8.5rem}
        .bq-bar{height:.9rem;border-radius:999px;background:rgba(255,255,255,.08);overflow:hidden}.bq-bar>span{display:block;height:100%;background:linear-gradient(90deg,#22c55e,#4ade80)}
        .bq-sched-wrap{margin-top:1.05rem;border-radius:1.55rem;border:1px solid rgba(255,255,255,.08);background:linear-gradient(180deg,rgba(255,255,255,.05),rgba(255,255,255,.025));padding:1rem 1rem 1.05rem}
        .bq-sched{border-radius:1rem;padding:.95rem 1rem;background:rgba(15,23,42,.48);border:1px solid rgba(255,255,255,.06);transition:transform .22s ease,border-color .22s ease,background .22s ease}
        .bq-sched:hover{transform:translateY(-2px);border-color:rgba(56,189,248,.2);background:rgba(15,23,42,.62)}
        .bq-canvas::-webkit-scrollbar{height:12px;width:12px}
        .bq-canvas::-webkit-scrollbar-track{background:rgba(15,23,42,.55);border-radius:999px}
        .bq-canvas::-webkit-scrollbar-thumb{background:linear-gradient(180deg,rgba(56,189,248,.8),rgba(59,130,246,.82));border-radius:999px;border:2px solid rgba(15,23,42,.55)}
        @media (min-width:1280px){.bq-side{position:sticky;top:6.4rem;align-self:start;max-height:calc(100vh - 7.4rem);overflow:auto}}
        @media (max-width:1279px){.bq{grid-template-columns:1fr}.bq-canvas{padding-right:1rem}.bq-rounds{padding-right:1.5rem}}
        @media (max-width:767px){.bq-side,.bq-board{border-radius:1.55rem}.bq-side{padding:1rem}.bq-board{padding:1rem}.bq-card{padding:.9rem}.bq-board-top{padding-bottom:.85rem}.bq-canvas{padding:.85rem .85rem 1.35rem}.bq-rounds{gap:1.6rem;padding-right:1rem}.bq-round{min-width:14.2rem}.bq-match{width:12.75rem}}
    </style>
    <div class="bq">
        <aside class="bq-side">
            <p class="text-[11px] tracking-[0.32em] uppercase text-cyan-300 font-semibold">Gaming Tools</p>
            <h2 class="mt-2 text-3xl font-black">Bracket HQ</h2>
            <p class="mt-3 text-sm leading-6 text-slate-300">Generate a real single-elimination bracket board with seeded matchups, match times, and a clean stream-style layout.</p>
            <div class="mt-6 space-y-4">
                <div class="bq-card">
                    <label class="block text-[11px] uppercase tracking-[0.22em] text-slate-400">Tournament Name<input id="bracketTitle" class="bq-field" value="Valorant Tourney"></label>
                    <div class="grid grid-cols-2 gap-3 mt-3">
                        <label class="block text-[11px] uppercase tracking-[0.22em] text-slate-400">Total Teams<input id="bracketTeamCount" type="number" min="2" max="32" step="1" class="bq-field" value="8"></label>
                        <label class="block text-[11px] uppercase tracking-[0.22em] text-slate-400">Bracket Size<select id="bracketSize" class="bq-field"><option value="auto">Auto Fit</option><option value="4">4</option><option value="8" selected>8</option><option value="16">16</option><option value="32">32</option></select></label>
                    </div>
                </div>
                <div class="bq-card">
                    <div class="grid grid-cols-2 gap-3">
                        <label class="block text-[11px] uppercase tracking-[0.22em] text-slate-400">Start Date<input id="bracketDate" type="date" class="bq-field"></label>
                        <label class="block text-[11px] uppercase tracking-[0.22em] text-slate-400">First Match<input id="bracketTime" type="time" class="bq-field" value="18:00"></label>
                    </div>
                    <div class="grid grid-cols-2 gap-3 mt-3">
                        <label class="block text-[11px] uppercase tracking-[0.22em] text-slate-400">Match Slot<select id="bracketInterval" class="bq-field"><option value="20">20 min</option><option value="30" selected>30 min</option><option value="45">45 min</option><option value="60">60 min</option></select></label>
                        <label class="block text-[11px] uppercase tracking-[0.22em] text-slate-400">Status<select id="bracketStatus" class="bq-field"><option value="open">Open</option><option value="check-in">Check-in</option><option value="in-progress" selected>In Progress</option><option value="complete">Complete</option></select></label>
                    </div>
                </div>
                <div class="bq-card">
                    <div class="flex items-center justify-between gap-3 mb-3"><span class="text-[11px] uppercase tracking-[0.22em] text-slate-400">Team Names</span><button id="bracketAutofillBtn" type="button" class="rounded-full bg-cyan-400/10 text-cyan-300 px-4 py-2 text-sm font-semibold border border-cyan-400/12">Autofill</button></div>
                    <textarea id="bracketNames" rows="10" class="bq-field min-h-[15rem] resize-y" placeholder="Team Agent&#10;Team Lacy">Team Agent
Team A
Team B
Team C
Team D
Team E
Team F
Team G</textarea>
                    <div class="mt-4 flex flex-wrap gap-3"><button id="bracketGenerateBtn" class="rounded-[1rem] bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-5 py-3.5 font-semibold shadow-[0_18px_40px_rgba(14,165,233,.26)]">Generate Bracket</button><button id="bracketShuffleBtn" class="rounded-[1rem] bg-white/8 text-white px-5 py-3.5 font-semibold border border-white/10 shadow-[inset_0_1px_0_rgba(255,255,255,.04)]">Shuffle Seeds</button></div>
                </div>
                <div id="bracketOverview" class="grid grid-cols-2 gap-3"></div>
                <div class="bq-card"><div class="flex items-center justify-between gap-3"><div><p class="text-[11px] uppercase tracking-[0.22em] text-slate-400">Bracket Status</p><p id="bracketStatusLabel" class="mt-2 text-xl font-black">In Progress</p></div><p id="bracketProgressText" class="text-sm font-semibold text-slate-300">57%</p></div><div class="bq-bar mt-4"><span id="bracketProgressFill" style="width:57%;"></span></div></div>
            </div>
        </aside>
        <section class="bq-board">
            <div class="bq-board-top"><div class="bq-board-head"><p class="text-[11px] tracking-[0.28em] uppercase text-cyan-300 font-semibold">Single Elimination</p><h3 id="bracketBoardTitle" class="mt-2 text-3xl font-black">Valorant Tourney</h3><p id="bracketBoardMeta" class="mt-2 text-sm text-slate-300">8 teams, randomized seeds, opening matches scheduled automatically.</p></div><div class="bq-board-stats"><div class="bq-stat"><p class="text-[11px] uppercase tracking-[0.22em] text-slate-400">Bracket Size</p><p id="bracketBoardSize" class="mt-2 text-2xl font-black">8</p></div><div class="bq-stat"><p class="text-[11px] uppercase tracking-[0.22em] text-slate-400">Matches</p><p id="bracketBoardMatches" class="mt-2 text-2xl font-black">7</p></div></div></div>
            <div class="bq-canvas"><div id="bracketCanvas" class="bq-rounds"></div></div>
            <div class="bq-sched-wrap"><div class="flex flex-wrap items-center justify-between gap-4"><div><p class="text-[11px] uppercase tracking-[0.22em] text-cyan-300">Schedule Feed</p><h4 class="mt-1 text-xl font-black text-white">Randomized Match Schedule</h4></div><p id="bracketScheduleMeta" class="text-sm text-slate-400">Generated from team list and match slot length</p></div><div id="bracketSchedule" class="mt-4 grid lg:grid-cols-2 gap-3"></div></div>
        </section>
    </div>
    <script>
        (() => {
            const H=88,G=22,byId=(id)=>document.getElementById(id);
            const namesEl=byId("bracketNames"), teamCountEl=byId("bracketTeamCount"), sizeEl=byId("bracketSize"), dateEl=byId("bracketDate"), timeEl=byId("bracketTime"), intervalEl=byId("bracketInterval"), statusEl=byId("bracketStatus"), titleEl=byId("bracketTitle");
            const canvas=byId("bracketCanvas"), scheduleEl=byId("bracketSchedule"), overviewEl=byId("bracketOverview");
            const boardTitleEl=byId("bracketBoardTitle"), boardMetaEl=byId("bracketBoardMeta"), boardSizeEl=byId("bracketBoardSize"), boardMatchesEl=byId("bracketBoardMatches");
            const statusLabelEl=byId("bracketStatusLabel"), progressTextEl=byId("bracketProgressText"), progressFillEl=byId("bracketProgressFill"), scheduleMetaEl=byId("bracketScheduleMeta");
            const statusMap={open:["Open",18],"check-in":["Check-in",36],"in-progress":["In Progress",57],complete:["Complete",100]};
            dateEl.valueAsDate=new Date();
            const getTeams=()=>namesEl.value.split(/\r?\n/).map(v=>v.trim()).filter(Boolean);
            const shuffle=(list)=>{const copy=list.slice();for(let i=copy.length-1;i>0;i--){const j=Math.floor(Math.random()*(i+1));[copy[i],copy[j]]=[copy[j],copy[i]];}return copy;};
            const slotTime=(d)=>d.toLocaleString([], {month:"short",day:"numeric",hour:"numeric",minute:"2-digit"});
            const startAt=()=>new Date(`${dateEl.value||new Date().toISOString().slice(0,10)}T${timeEl.value||"18:00"}:00`);
            const bracketSize=(count)=>sizeEl.value==="auto"?Math.pow(2,Math.ceil(Math.log2(Math.max(2,count)))):Math.max(parseInt(sizeEl.value,10)||2,count);
            const roundTitle=(i,total)=>i===total-1?"Final":i===total-2&&total>2?"Semifinal":i===total-3?"Quarterfinal":`Round ${i+1}`;
            function build(rawTeams){const limit=bracketSize(rawTeams.length), seeded=shuffle(rawTeams).slice(0,limit).map((name,index)=>({seed:index+1,name})); while(seeded.length<limit) seeded.push({seed:seeded.length+1,name:"BYE",bye:true}); const rounds=[], schedule=[]; let current=seeded, now=startAt(), id=1; while(current.length>1){const round=[], next=[]; for(let i=0;i<current.length;i+=2){const top=current[i], bottom=current[i+1], adv=top?.bye?bottom:bottom?.bye?top:null; round.push({id,time:slotTime(now),top:{seed:top?.seed??"",name:top?.name??"TBD",bye:!!top?.bye,win:adv===top},bottom:{seed:bottom?.seed??"",name:bottom?.name??"TBD",bye:!!bottom?.bye,win:adv===bottom}}); schedule.push({id,time:slotTime(now),round:rounds.length+1,top:top?.name??"TBD",bottom:bottom?.name??"TBD"}); next.push({seed:adv?.seed??Math.min(top?.seed??99,bottom?.seed??99),name:adv?.name??`Winner M${id}`}); now=new Date(now.getTime()+(parseInt(intervalEl.value,10)||30)*60000); id++; } rounds.push(round); current=next; } return {rounds,schedule,size:seeded.length,matches:schedule.length}; }
            function renderStatus(){const c=statusMap[statusEl.value]||statusMap["in-progress"]; statusLabelEl.textContent=c[0]; progressTextEl.textContent=`${c[1]}%`; progressFillEl.style.width=`${c[1]}%`;}
            function renderOverview(plan,count){overviewEl.innerHTML=`<div class="bq-stat"><p class="text-[11px] uppercase tracking-[0.22em] text-slate-400">Teams</p><p class="mt-2 text-2xl font-black">${count}</p></div><div class="bq-stat"><p class="text-[11px] uppercase tracking-[0.22em] text-slate-400">Rounds</p><p class="mt-2 text-2xl font-black">${plan.rounds.length}</p></div><div class="bq-stat"><p class="text-[11px] uppercase tracking-[0.22em] text-slate-400">Byes</p><p class="mt-2 text-2xl font-black">${Math.max(0,plan.size-count)}</p></div><div class="bq-stat"><p class="text-[11px] uppercase tracking-[0.22em] text-slate-400">First Match</p><p class="mt-2 text-xl font-black">${plan.schedule[0]?.time||"TBD"}</p></div>`;}
            function renderBoard(plan,count){canvas.innerHTML=""; plan.rounds.forEach((round,ri)=>{const spacing=(H+G)*Math.pow(2,ri), gap=Math.max(G,spacing-H), offset=ri===0?0:((H+G)*Math.pow(2,ri-1))/2, span=(H+gap)/2; const col=document.createElement("section"); col.className="bq-round"; col.style.paddingTop=`${offset}px`; col.style.gap=`${gap}px`; col.innerHTML=`<div class="bq-stage"><p class="text-[11px] uppercase tracking-[0.22em] text-cyan-300">Stage ${ri+1}</p><h4 class="mt-1 text-xl font-black text-white">${roundTitle(ri,plan.rounds.length)}</h4></div>`; round.forEach((match,mi)=>{const final=ri===plan.rounds.length-1; const row=(team)=>`<div class="bq-row ${team.win?"win":""} ${team.bye||String(team.name).startsWith("Winner M")?"dim":""}"><span class="bq-seed">${team.seed}</span><span class="bq-name">${team.name}</span><span class="bq-score">${team.win?"ADV":""}</span></div>`; const wrap=document.createElement("article"); wrap.className="bq-match"; wrap.style.setProperty("--span",`${span}px`); wrap.innerHTML=`<span class="bq-pill">M${match.id} - ${match.time}</span><div class="bq-box">${row(match.top)}${row(match.bottom)}</div>${final?"":'<span class="bq-h"></span>'}${final?"":mi%2===0?'<span class="bq-v down"></span>':'<span class="bq-v up"></span>'}`; col.appendChild(wrap);}); canvas.appendChild(col);}); boardTitleEl.textContent=titleEl.value.trim()||"Tournament Bracket"; boardMetaEl.textContent=`${count} teams, randomized seeds, opening matches scheduled automatically.`; boardSizeEl.textContent=String(plan.size); boardMatchesEl.textContent=String(plan.matches); }
            function renderSchedule(plan){scheduleEl.innerHTML=plan.schedule.map(m=>`<article class="bq-sched"><p class="text-[11px] uppercase tracking-[0.22em] text-cyan-300">Round ${m.round} - Match ${m.id}</p><h5 class="mt-1 text-base font-black text-white">${m.top} <span class="text-slate-500">vs</span> ${m.bottom}</h5><p class="mt-2 text-sm font-semibold text-slate-300">${m.time}</p></article>`).join(""); scheduleMetaEl.textContent=`${plan.matches} matches built from randomized seeds and your time slot length.`;}
            function generate(){const count=Math.max(2,parseInt(teamCountEl.value,10)||2), teams=getTeams().slice(0,count); if(teams.length<2){canvas.innerHTML='<div class="bq-sched text-slate-300">Add at least two team names to generate the bracket.</div>'; scheduleEl.innerHTML=""; overviewEl.innerHTML=""; boardTitleEl.textContent="Tournament Bracket"; boardMetaEl.textContent="Add more teams to render the bracket board."; boardSizeEl.textContent="0"; boardMatchesEl.textContent="0"; renderStatus(); return;} const plan=build(teams); renderOverview(plan,teams.length); renderBoard(plan,teams.length); renderSchedule(plan); renderStatus();}
            byId("bracketAutofillBtn").addEventListener("click",()=>{const count=Math.max(2,parseInt(teamCountEl.value,10)||2); namesEl.value=Array.from({length:count},(_,i)=>`Team ${i+1}`).join("\n"); generate();});
            byId("bracketShuffleBtn").addEventListener("click",()=>{namesEl.value=shuffle(getTeams()).join("\n"); generate();});
            byId("bracketGenerateBtn").addEventListener("click",generate);
            [teamCountEl,sizeEl,dateEl,timeEl,intervalEl,statusEl].forEach(el=>el.addEventListener("input",generate));
            titleEl.addEventListener("input",generate);
            generate();
        })();
    </script>
HTML;
}
function getSpinWheelHTML() {
    return <<<'HTML'
    <div class="max-w-6xl mx-auto grid xl:grid-cols-[0.95fr_1.05fr] gap-6">
        <div class="rounded-[34px] border border-fuchsia-200/60 dark:border-fuchsia-500/15 bg-gradient-to-br from-white via-fuchsia-50/70 to-violet-50/60 dark:from-slate-950 dark:via-slate-950 dark:to-slate-900 shadow-[0_24px_80px_rgba(217,70,239,0.12)] p-6 md:p-8">
            <p class="text-[11px] tracking-[0.34em] uppercase text-fuchsia-500 font-semibold">Fun Tools</p>
            <h2 class="mt-2 text-3xl font-black text-slate-900 dark:text-white">Spin the Wheel</h2>
            <p class="mt-3 text-sm text-slate-500 dark:text-slate-400">Add your options, spin the wheel, and let chance pick the winner.</p>
            <textarea id="wheelOptions" rows="10" class="mt-6 w-full rounded-[28px] border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-950/70 px-4 py-4 text-slate-900 dark:text-white" placeholder="Pizza&#10;Burger&#10;Pasta&#10;Sushi">Pizza
Burger
Pasta
Sushi
Tacos
Fries</textarea>
            <div class="mt-6 flex flex-wrap gap-3">
                <button id="wheelSpinBtn" class="rounded-[28px] bg-gradient-to-r from-fuchsia-500 to-violet-500 text-white px-6 py-4 font-semibold shadow-[0_20px_45px_rgba(217,70,239,0.28)]">Spin Wheel</button>
                <button id="wheelShuffleBtn" class="rounded-[28px] bg-slate-900 dark:bg-white text-white dark:text-slate-900 px-6 py-4 font-semibold">Shuffle Options</button>
            </div>
        </div>
        <div class="rounded-[34px] border border-slate-200 dark:border-slate-800 bg-slate-950 p-6 text-white shadow-[0_24px_80px_rgba(15,23,42,0.35)]">
            <p class="text-xs uppercase tracking-[0.22em] text-fuchsia-300">Result</p>
            <div id="wheelWinner" class="mt-3 text-4xl font-black">Ready to spin</div>
            <div class="mt-6 flex justify-center">
                <canvas id="wheelCanvas" width="420" height="420" class="max-w-full"></canvas>
            </div>
        </div>
    </div>
    <script>
        (() => {
            const canvas = document.getElementById("wheelCanvas"), ctx = canvas.getContext("2d");
            const textarea = document.getElementById("wheelOptions"), winnerEl = document.getElementById("wheelWinner");
            let rotation = 0;
            const colors = ["#ec4899","#8b5cf6","#06b6d4","#10b981","#f59e0b","#ef4444","#3b82f6","#14b8a6"];
            function getOptions() { return textarea.value.split(/\r?\n/).map(v => v.trim()).filter(Boolean).slice(0, 12); }
            function draw() {
                const options = getOptions();
                const total = options.length || 1;
                const arc = (Math.PI * 2) / total;
                ctx.clearRect(0,0,canvas.width,canvas.height);
                ctx.save();
                ctx.translate(canvas.width/2, canvas.height/2);
                ctx.rotate(rotation);
                for (let i = 0; i < total; i++) {
                    ctx.beginPath();
                    ctx.moveTo(0,0);
                    ctx.arc(0,0,170,i*arc,(i+1)*arc);
                    ctx.closePath();
                    ctx.fillStyle = colors[i % colors.length];
                    ctx.fill();
                    ctx.save();
                    ctx.rotate(i*arc + arc/2);
                    ctx.fillStyle = "#fff";
                    ctx.font = "bold 16px DM Sans, sans-serif";
                    ctx.textAlign = "right";
                    ctx.fillText(options[i] || "Option", 145, 6);
                    ctx.restore();
                }
                ctx.restore();
                ctx.fillStyle = "#fff";
                ctx.beginPath();
                ctx.moveTo(canvas.width/2, 18);
                ctx.lineTo(canvas.width/2 - 14, 48);
                ctx.lineTo(canvas.width/2 + 14, 48);
                ctx.closePath();
                ctx.fill();
            }
            function pickWinner() {
                const options = getOptions();
                if (!options.length) return;
                const total = options.length;
                const arc = (Math.PI * 2) / total;
                const normalized = ((Math.PI * 1.5 - rotation) % (Math.PI * 2) + Math.PI * 2) % (Math.PI * 2);
                const index = Math.floor(normalized / arc) % total;
                winnerEl.textContent = options[index];
            }
            document.getElementById("wheelSpinBtn").addEventListener("click", () => {
                const extra = Math.PI * 2 * (4 + Math.random() * 3);
                const target = rotation + extra;
                const start = performance.now();
                const initial = rotation;
                function animate(now) {
                    const t = Math.min(1, (now - start) / 3200);
                    const eased = 1 - Math.pow(1 - t, 4);
                    rotation = initial + (target - initial) * eased;
                    draw();
                    if (t < 1) requestAnimationFrame(animate);
                    else pickWinner();
                }
                requestAnimationFrame(animate);
            });
            document.getElementById("wheelShuffleBtn").addEventListener("click", () => {
                const opts = getOptions().sort(() => Math.random() - 0.5);
                textarea.value = opts.join("\n");
                draw();
            });
            textarea.addEventListener("input", draw);
            draw();
        })();
    </script>
HTML;
}

function getRandomNamePickerHTML() {
    return <<<'HTML'
    <div class="max-w-5xl mx-auto grid xl:grid-cols-[1fr_0.95fr] gap-6">
        <div class="rounded-[34px] border border-emerald-200/60 dark:border-emerald-500/15 bg-gradient-to-br from-white via-emerald-50/70 to-teal-50/60 dark:from-slate-950 dark:via-slate-950 dark:to-slate-900 shadow-[0_24px_80px_rgba(16,185,129,0.12)] p-6 md:p-8">
            <p class="text-[11px] tracking-[0.34em] uppercase text-emerald-500 font-semibold">Fun Tools</p>
            <h2 class="mt-2 text-3xl font-black text-slate-900 dark:text-white">Random Name Picker</h2>
            <p class="mt-3 text-sm text-slate-500 dark:text-slate-400">Paste names for giveaways, classrooms, lobbies, or team selection.</p>
            <textarea id="pickerNames" rows="12" class="mt-6 w-full rounded-[28px] border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-950/70 px-4 py-4 text-slate-900 dark:text-white" placeholder="Ali&#10;Sara&#10;Umair&#10;Hassan">Ali
Sara
Umair
Hassan
Ayesha</textarea>
            <div class="mt-6 flex flex-wrap gap-3">
                <button id="pickerPickBtn" class="rounded-[28px] bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-6 py-4 font-semibold shadow-[0_20px_45px_rgba(16,185,129,0.28)]">Pick Random Name</button>
                <button id="pickerRemoveBtn" class="rounded-[28px] bg-slate-900 dark:bg-white text-white dark:text-slate-900 px-6 py-4 font-semibold">Remove Winner</button>
            </div>
        </div>
        <div class="grid gap-4">
            <div class="rounded-[34px] border border-slate-200 dark:border-slate-800 bg-slate-950 p-6 text-white shadow-[0_24px_80px_rgba(15,23,42,0.35)]">
                <p class="text-xs uppercase tracking-[0.22em] text-emerald-300">Selected Name</p>
                <div id="pickerWinner" class="mt-3 text-5xl font-black">No pick yet</div>
            </div>
            <div class="rounded-[28px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 p-5">
                <p class="text-xs uppercase tracking-[0.22em] text-slate-500">Remaining Count</p>
                <p id="pickerCount" class="mt-3 text-3xl font-black text-slate-900 dark:text-white">0</p>
            </div>
        </div>
    </div>
    <script>
        (() => {
            const textarea = document.getElementById("pickerNames"), winnerEl = document.getElementById("pickerWinner"), countEl = document.getElementById("pickerCount");
            let lastWinner = "";
            function getNames() { return textarea.value.split(/\r?\n/).map(v => v.trim()).filter(Boolean); }
            function syncCount() { countEl.textContent = String(getNames().length); }
            document.getElementById("pickerPickBtn").addEventListener("click", () => {
                const names = getNames();
                if (!names.length) return;
                lastWinner = names[Math.floor(Math.random() * names.length)];
                winnerEl.textContent = lastWinner;
            });
            document.getElementById("pickerRemoveBtn").addEventListener("click", () => {
                if (!lastWinner) return;
                const names = getNames().filter(name => name !== lastWinner);
                textarea.value = names.join("\n");
                lastWinner = "";
                winnerEl.textContent = "Removed last winner";
                syncCount();
            });
            textarea.addEventListener("input", syncCount);
            syncCount();
        })();
    </script>
HTML;
}

function getTypingSpeedTestHTML() {
    return <<<'HTML'
    <div class="max-w-6xl mx-auto grid xl:grid-cols-[1.05fr_0.95fr] gap-6">
        <div class="rounded-[34px] border border-orange-200/60 dark:border-orange-500/15 bg-gradient-to-br from-white via-orange-50/70 to-amber-50/60 dark:from-slate-950 dark:via-slate-950 dark:to-slate-900 shadow-[0_24px_80px_rgba(249,115,22,0.12)] p-6 md:p-8">
            <p class="text-[11px] tracking-[0.34em] uppercase text-orange-500 font-semibold">Fun Tools</p>
            <h2 class="mt-2 text-3xl font-black text-slate-900 dark:text-white">Typing Speed Test</h2>
            <p id="typingPrompt" class="mt-6 rounded-[28px] border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-950/70 px-5 py-5 text-lg leading-8 text-slate-900 dark:text-white"></p>
            <textarea id="typingInput" rows="7" class="mt-6 w-full rounded-[28px] border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-950/70 px-4 py-4 text-slate-900 dark:text-white" placeholder="Start typing here..."></textarea>
            <div class="mt-6 flex flex-wrap gap-3">
                <button id="typingResetBtn" class="rounded-[28px] bg-gradient-to-r from-orange-500 to-amber-500 text-white px-6 py-4 font-semibold shadow-[0_20px_45px_rgba(249,115,22,0.28)]">New Test</button>
            </div>
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
            <div class="rounded-[34px] border border-slate-200 dark:border-slate-800 bg-slate-950 p-6 text-white shadow-[0_24px_80px_rgba(15,23,42,0.35)]"><p class="text-xs uppercase tracking-[0.22em] text-orange-300">WPM</p><div id="typingWpm" class="mt-3 text-5xl font-black">0</div></div>
            <div class="rounded-[34px] border border-slate-200 dark:border-slate-800 bg-slate-950 p-6 text-white shadow-[0_24px_80px_rgba(15,23,42,0.35)]"><p class="text-xs uppercase tracking-[0.22em] text-orange-300">Accuracy</p><div id="typingAccuracy" class="mt-3 text-5xl font-black">100%</div></div>
            <div class="rounded-[28px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 p-5"><p class="text-xs uppercase tracking-[0.22em] text-slate-500">Time</p><p id="typingTime" class="mt-3 text-3xl font-black text-slate-900 dark:text-white">0s</p></div>
            <div class="rounded-[28px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 p-5"><p class="text-xs uppercase tracking-[0.22em] text-slate-500">Characters</p><p id="typingChars" class="mt-3 text-3xl font-black text-slate-900 dark:text-white">0</p></div>
        </div>
        <div class="mt-4 rounded-[28px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 p-5">
            <div class="flex items-center justify-between gap-3">
                <p class="text-xs uppercase tracking-[0.22em] text-slate-500">Global Leaderboard</p>
                <span class="text-[11px] font-bold uppercase tracking-[0.18em] text-orange-500 dark:text-orange-300">Top 10</span>
            </div>
            <div id="typingLeaderboard" class="mt-4 grid gap-3"></div>
        </div>
    </div>
    <script>
        (() => {
            const prompts = [
                "Speed matters, but clarity always wins when you type under pressure.",
                "The best fun tools are simple to use and surprisingly hard to stop trying.",
                "Gamers, creators, and students all love tiny tools that solve one clear job well.",
                "A focused workflow beats a complicated one when you just want quick results.",
                "Creative people usually save more time when their tools stay lightweight and fast.",
                "Short typing sprints are a fun way to sharpen accuracy and rhythm every day.",
                "The internet rewards products that are useful first and delightful right after.",
                "Good interfaces feel obvious before they feel impressive to the person using them.",
                "Simple ideas often spread faster online because anyone can understand them instantly."
            ];
            const promptEl = document.getElementById("typingPrompt"), inputEl = document.getElementById("typingInput"), leaderboardEl = document.getElementById("typingLeaderboard");
            let currentPrompt = "", startTime = 0, promptPool = [], runSaved = false;
            function loadLeaderboard() {
                if (!window.any2convertLeaderboard) return;
                window.any2convertLeaderboard.fetch("typing_speed_test")
                    .then((data) => window.any2convertLeaderboard.render(leaderboardEl, data, {
                        emptyText: "No typing records yet. Finish a clean run to set the pace.",
                        loginText: "Log in to save your typing result to the public leaderboard."
                    }))
                    .catch(() => {
                        leaderboardEl.innerHTML = '<div class="rounded-2xl border border-dashed border-slate-200 dark:border-slate-800 px-4 py-5 text-sm text-slate-500 dark:text-slate-400">Could not load the leaderboard right now.</div>';
                    });
            }
            function saveRun(wpm, accuracy, elapsedSeconds) {
                if (runSaved || !window.any2convertLeaderboard) return;
                runSaved = true;
                window.any2convertLeaderboard.save("typing_speed_test", {
                    primary_score: wpm,
                    secondary_score: accuracy,
                    score_label: `${wpm} WPM`,
                    score_meta: `${accuracy}% accuracy � ${elapsedSeconds}s`
                }).then(() => loadLeaderboard()).catch(() => loadLeaderboard());
            }
            function nextPrompt() {
                if (!promptPool.length) {
                    promptPool = prompts.slice().sort(() => Math.random() - 0.5);
                }
                currentPrompt = promptPool.pop();
            }
            function reset() {
                nextPrompt();
                promptEl.textContent = currentPrompt;
                inputEl.value = "";
                startTime = 0;
                runSaved = false;
                document.getElementById("typingWpm").textContent = "0";
                document.getElementById("typingAccuracy").textContent = "100%";
                document.getElementById("typingTime").textContent = "0s";
                document.getElementById("typingChars").textContent = "0";
            }
            inputEl.addEventListener("input", () => {
                if (!startTime && inputEl.value.length) startTime = Date.now();
                const elapsedMin = Math.max((Date.now() - startTime) / 60000, 1 / 60000);
                const typed = inputEl.value;
                let correct = 0;
                for (let i = 0; i < typed.length; i++) if (typed[i] === currentPrompt[i]) correct++;
                const wpm = Math.round((typed.trim().length / 5) / elapsedMin);
                const accuracy = typed.length ? Math.round((correct / typed.length) * 100) : 100;
                const elapsedSeconds = Math.floor((Date.now() - startTime) / 1000);
                document.getElementById("typingWpm").textContent = String(Math.max(0, wpm));
                document.getElementById("typingAccuracy").textContent = `${accuracy}%`;
                document.getElementById("typingTime").textContent = `${elapsedSeconds}s`;
                document.getElementById("typingChars").textContent = String(typed.length);
                if (typed === currentPrompt) {
                    saveRun(Math.max(0, wpm), accuracy, elapsedSeconds);
                }
            });
            document.getElementById("typingResetBtn").addEventListener("click", reset);
            reset();
            loadLeaderboard();
        })();
    </script>
HTML;
}

function getMemeCaptionGeneratorHTML() {
    return <<<'HTML'
    <div class="max-w-6xl mx-auto grid xl:grid-cols-[0.95fr_1.05fr] gap-6">
        <div class="rounded-[34px] border border-sky-200/60 dark:border-sky-500/15 bg-gradient-to-br from-white via-sky-50/70 to-blue-50/60 dark:from-slate-950 dark:via-slate-950 dark:to-slate-900 shadow-[0_24px_80px_rgba(14,165,233,0.12)] p-6 md:p-8">
            <p class="text-[11px] tracking-[0.34em] uppercase text-sky-500 font-semibold">Fun Tools</p>
            <h2 class="mt-2 text-3xl font-black text-slate-900 dark:text-white">Meme Caption Generator</h2>
            <input id="memeImageInput" type="file" accept="image/*" class="mt-6 block w-full rounded-[24px] border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-950/70 px-4 py-4 text-slate-900 dark:text-white">
            <div class="mt-5 grid gap-4">
                <input id="memeTopText" class="w-full rounded-[24px] border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-950/70 px-4 py-4 text-slate-900 dark:text-white" placeholder="TOP TEXT">
                <input id="memeBottomText" class="w-full rounded-[24px] border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-950/70 px-4 py-4 text-slate-900 dark:text-white" placeholder="BOTTOM TEXT">
            </div>
            <div class="mt-6 flex flex-wrap gap-3">
                <button id="memeRenderBtn" class="rounded-[28px] bg-gradient-to-r from-sky-500 to-blue-500 text-white px-6 py-4 font-semibold shadow-[0_20px_45px_rgba(14,165,233,0.28)]">Render Meme</button>
                <button id="memeDownloadBtn" class="rounded-[28px] bg-slate-900 dark:bg-white text-white dark:text-slate-900 px-6 py-4 font-semibold">Download PNG</button>
            </div>
        </div>
        <div class="rounded-[34px] border border-slate-200 dark:border-slate-800 bg-slate-950 p-6 text-white shadow-[0_24px_80px_rgba(15,23,42,0.35)]">
            <p class="text-xs uppercase tracking-[0.22em] text-sky-300">Preview</p>
            <div class="mt-4 min-h-[360px] rounded-[28px] border border-white/10 bg-white/5 flex items-center justify-center overflow-hidden">
                <canvas id="memeCanvas" class="max-w-full"></canvas>
            </div>
        </div>
    </div>
    <script>
        (() => {
            const input = document.getElementById("memeImageInput"), canvas = document.getElementById("memeCanvas"), ctx = canvas.getContext("2d");
            let img = null;
            function render() {
                if (!img) return;
                canvas.width = img.width;
                canvas.height = img.height;
                ctx.drawImage(img, 0, 0);
                ctx.textAlign = "center";
                ctx.fillStyle = "#fff";
                ctx.strokeStyle = "#000";
                ctx.lineWidth = Math.max(4, canvas.width / 120);
                ctx.font = `bold ${Math.max(28, canvas.width / 10)}px Impact, Arial Black, sans-serif`;
                const top = (document.getElementById("memeTopText").value || "").toUpperCase();
                const bottom = (document.getElementById("memeBottomText").value || "").toUpperCase();
                if (top) { ctx.strokeText(top, canvas.width / 2, 60); ctx.fillText(top, canvas.width / 2, 60); }
                if (bottom) { ctx.strokeText(bottom, canvas.width / 2, canvas.height - 30); ctx.fillText(bottom, canvas.width / 2, canvas.height - 30); }
            }
            input.addEventListener("change", () => {
                const file = input.files?.[0];
                if (!file) return;
                const image = new Image();
                image.onload = () => { img = image; render(); };
                image.src = URL.createObjectURL(file);
            });
            document.getElementById("memeRenderBtn").addEventListener("click", render);
            document.getElementById("memeDownloadBtn").addEventListener("click", () => {
                if (!canvas.width) return;
                const a = document.createElement("a");
                a.href = canvas.toDataURL("image/png");
                a.download = "meme.png";
                a.click();
            });
            ["memeTopText","memeBottomText"].forEach(id => document.getElementById(id).addEventListener("input", render));
        })();
    </script>
HTML;
}

function getTruthOrDareGeneratorHTML() {
    return <<<'HTML'
    <div class="max-w-5xl mx-auto grid xl:grid-cols-[1fr_0.95fr] gap-6">
        <div class="rounded-[34px] border border-rose-200/60 dark:border-rose-500/15 bg-gradient-to-br from-white via-rose-50/70 to-pink-50/60 dark:from-slate-950 dark:via-slate-950 dark:to-slate-900 shadow-[0_24px_80px_rgba(244,63,94,0.12)] p-6 md:p-8">
            <p class="text-[11px] tracking-[0.34em] uppercase text-rose-500 font-semibold">Fun Tools</p>
            <h2 class="mt-2 text-3xl font-black text-slate-900 dark:text-white">Truth or Dare Generator</h2>
            <p class="mt-3 text-sm text-slate-500 dark:text-slate-400">Need an instant party prompt? Generate fun truths and dares in one click.</p>
            <div class="mt-6 flex flex-wrap gap-3">
                <button id="truthBtn" class="rounded-[28px] bg-gradient-to-r from-rose-500 to-pink-500 text-white px-6 py-4 font-semibold shadow-[0_20px_45px_rgba(244,63,94,0.28)]">Truth</button>
                <button id="dareBtn" class="rounded-[28px] bg-slate-900 dark:bg-white text-white dark:text-slate-900 px-6 py-4 font-semibold">Dare</button>
            </div>
        </div>
        <div class="rounded-[34px] border border-slate-200 dark:border-slate-800 bg-slate-950 p-6 text-white shadow-[0_24px_80px_rgba(15,23,42,0.35)]">
            <p class="text-xs uppercase tracking-[0.22em] text-rose-300">Prompt</p>
            <div id="todType" class="mt-3 text-sm uppercase tracking-[0.28em] text-slate-400">Truth</div>
            <div id="todPrompt" class="mt-4 text-3xl font-black leading-tight">Press a button to get started.</div>
        </div>
    </div>
    <script>
        (() => {
            const truths = [
                "What is one thing you have pretended to like just to fit in?",
                "What is the most awkward message you have accidentally sent?",
                "If you had to swap lives with one friend for a week, who would it be?",
                "What is a harmless lie you have told more than once?",
                "What is the funniest reason you have ever been embarrassed?",
                "What is one skill you wish people knew you were actually good at?",
                "What is a totally irrational fear you still have?",
                "What is one thing on your phone you hope nobody asks to see?"
            ];
            const dares = [
                "Speak in a dramatic movie trailer voice for the next two minutes.",
                "Send the funniest selfie you can make to a friend.",
                "Do your best victory dance right now.",
                "Narrate everything you do for one minute like a sports commentator.",
                "Try to balance on one foot while introducing yourself like a celebrity.",
                "Make up a ridiculous product ad on the spot and perform it.",
                "Text someone only using emojis for the next message you send.",
                "Pretend you just won a championship and give a victory speech."
            ];
            let truthPool = [], darePool = [];
            function nextFrom(poolRef, list) {
                if (!poolRef.length) {
                    poolRef.push(...list.slice().sort(() => Math.random() - 0.5));
                }
                return poolRef.pop();
            }
            function setPrompt(type, list) {
                document.getElementById("todType").textContent = type;
                document.getElementById("todPrompt").textContent = type === "Truth" ? nextFrom(truthPool, list) : nextFrom(darePool, list);
            }
            document.getElementById("truthBtn").addEventListener("click", () => setPrompt("Truth", truths));
            document.getElementById("dareBtn").addEventListener("click", () => setPrompt("Dare", dares));
        })();
    </script>
HTML;
}

function getMemoryMatchGameHTML() {
    return <<<'HTML'
    <div class="max-w-6xl mx-auto grid xl:grid-cols-[0.92fr_1.08fr] gap-6">
        <div class="rounded-[34px] border border-fuchsia-200/70 dark:border-fuchsia-500/15 bg-gradient-to-br from-white via-fuchsia-50/70 to-indigo-50/70 dark:from-slate-950 dark:via-slate-950 dark:to-slate-900 shadow-[0_24px_80px_rgba(217,70,239,0.12)] p-6 md:p-8">
            <p class="text-[11px] tracking-[0.34em] uppercase text-fuchsia-500 font-semibold">Fun Tools</p>
            <h2 class="mt-2 text-3xl font-black text-slate-900 dark:text-white">Memory Match Game</h2>
            <p class="mt-3 text-sm text-slate-500 dark:text-slate-400">Flip cards, match pairs, and try to finish the board in the fewest moves. Every restart shuffles the deck again.</p>

            <div class="mt-6 grid sm:grid-cols-2 gap-4">
                <label class="rounded-[24px] border border-slate-200/80 dark:border-slate-700/70 bg-white/80 dark:bg-slate-900/80 p-4">
                    <span class="block text-[11px] uppercase tracking-[0.22em] text-slate-400 mb-2">Difficulty</span>
                    <select id="memoryDifficulty" class="w-full min-h-[56px] rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 px-4 text-[15px] font-bold text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-fuchsia-500/30">
                        <option value="12">Easy � 12 cards</option>
                        <option value="16" selected>Normal � 16 cards</option>
                        <option value="20">Hard � 20 cards</option>
                    </select>
                </label>
                <label class="rounded-[24px] border border-slate-200/80 dark:border-slate-700/70 bg-white/80 dark:bg-slate-900/80 p-4">
                    <span class="block text-[11px] uppercase tracking-[0.22em] text-slate-400 mb-2">Theme</span>
                    <select id="memoryTheme" class="w-full min-h-[56px] rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 px-4 text-[15px] font-bold text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-fuchsia-500/30">
                        <option value="emoji" selected>Emoji Party</option>
                        <option value="gaming">Gaming Icons</option>
                        <option value="space">Space Mix</option>
                    </select>
                </label>
            </div>

            <div class="mt-5 grid grid-cols-3 gap-3">
                <div class="rounded-[22px] border border-slate-200/80 dark:border-slate-700/70 bg-white/80 dark:bg-slate-900/75 p-4">
                    <p class="text-[11px] uppercase tracking-[0.22em] text-slate-400">Moves</p>
                    <div id="memoryMoves" class="mt-2 text-2xl font-black text-slate-900 dark:text-white">0</div>
                </div>
                <div class="rounded-[22px] border border-slate-200/80 dark:border-slate-700/70 bg-white/80 dark:bg-slate-900/75 p-4">
                    <p class="text-[11px] uppercase tracking-[0.22em] text-slate-400">Matches</p>
                    <div id="memoryMatches" class="mt-2 text-2xl font-black text-slate-900 dark:text-white">0</div>
                </div>
                <div class="rounded-[22px] border border-slate-200/80 dark:border-slate-700/70 bg-white/80 dark:bg-slate-900/75 p-4">
                    <p class="text-[11px] uppercase tracking-[0.22em] text-slate-400">Timer</p>
                    <div id="memoryTimer" class="mt-2 text-2xl font-black text-slate-900 dark:text-white">00:00</div>
                </div>
            </div>

            <div class="mt-6 flex flex-wrap gap-3">
                <button id="memoryStartBtn" class="rounded-[24px] bg-gradient-to-r from-fuchsia-500 via-pink-500 to-indigo-500 text-white px-6 py-4 font-semibold shadow-[0_20px_45px_rgba(217,70,239,0.24)]">Start New Game</button>
                <button id="memoryPeekBtn" class="rounded-[24px] bg-slate-900 dark:bg-white text-white dark:text-slate-900 px-6 py-4 font-semibold">Quick Peek</button>
            </div>

            <div id="memoryStatus" class="mt-5 rounded-[24px] border border-fuchsia-200/70 dark:border-fuchsia-500/20 bg-fuchsia-50/80 dark:bg-fuchsia-500/10 px-5 py-4 text-sm text-fuchsia-700 dark:text-fuchsia-200">
                Start a round and match every pair before the board beats your focus.
            </div>
        </div>

        <div class="rounded-[34px] border border-slate-200/80 dark:border-slate-800 bg-white/92 dark:bg-slate-950 p-5 md:p-6 shadow-[0_24px_80px_rgba(15,23,42,0.14)] dark:shadow-[0_24px_80px_rgba(15,23,42,0.35)] text-slate-900 dark:text-white">
            <div class="flex items-center justify-between gap-4 mb-4">
                <div>
                    <p class="text-[11px] uppercase tracking-[0.24em] text-fuchsia-500 dark:text-fuchsia-300">Live Board</p>
                    <h3 class="mt-2 text-xl font-black text-slate-900 dark:text-white">Tap two cards to find a pair</h3>
                </div>
                <div id="memoryBest" class="rounded-full border border-slate-200 dark:border-white/10 bg-slate-100 dark:bg-white/5 px-4 py-2 text-xs font-semibold text-slate-600 dark:text-slate-300">Best: --</div>
            </div>
            <div id="memoryBoard" class="grid grid-cols-4 gap-3"></div>
            <div class="mt-5 rounded-[28px] border border-slate-200 dark:border-slate-800 bg-white/85 dark:bg-slate-950/75 p-5">
                <div class="flex items-center justify-between gap-3">
                    <p class="text-xs uppercase tracking-[0.22em] text-slate-500">Global Leaderboard</p>
                    <span class="text-[11px] font-bold uppercase tracking-[0.18em] text-fuchsia-500 dark:text-fuchsia-300">Top 10</span>
                </div>
                <div id="memoryLeaderboard" class="mt-4 grid gap-3"></div>
            </div>
        </div>
    </div>
    <script>
        (() => {
            const themes = {
                emoji: ["??","??","??","??","??","??","?","??","??","??"],
                gaming: ["??","???","??","??","??","??","??","???","??","??"],
                space: ["??","??","??","?","??","??","??","??","?????","??"]
            };
            const board = document.getElementById("memoryBoard");
            const movesEl = document.getElementById("memoryMoves");
            const matchesEl = document.getElementById("memoryMatches");
            const timerEl = document.getElementById("memoryTimer");
            const statusEl = document.getElementById("memoryStatus");
            const bestEl = document.getElementById("memoryBest");
            const leaderboardEl = document.getElementById("memoryLeaderboard");
            const difficultyEl = document.getElementById("memoryDifficulty");
            const themeEl = document.getElementById("memoryTheme");
            const bestKey = "any2convert-memory-best";
            let firstCard = null;
            let lockBoard = false;
            let moves = 0;
            let matches = 0;
            let totalPairs = 0;
            let seconds = 0;
            let timer = null;

            function formatTime(totalSeconds) {
                const mins = String(Math.floor(totalSeconds / 60)).padStart(2, "0");
                const secs = String(totalSeconds % 60).padStart(2, "0");
                return `${mins}:${secs}`;
            }

            function updateBest() {
                const best = JSON.parse(localStorage.getItem(bestKey) || "{}");
                const key = `${difficultyEl.value}-${themeEl.value}`;
                if (best[key]) {
                    bestEl.textContent = `Best: ${best[key].moves} moves � ${best[key].time}`;
                } else {
                    bestEl.textContent = "Best: --";
                }
            }

            function saveBest() {
                const key = `${difficultyEl.value}-${themeEl.value}`;
                const best = JSON.parse(localStorage.getItem(bestKey) || "{}");
                const current = { moves, time: formatTime(seconds), seconds };
                if (!best[key] || current.moves < best[key].moves || (current.moves === best[key].moves && current.seconds < best[key].seconds)) {
                    best[key] = current;
                    localStorage.setItem(bestKey, JSON.stringify(best));
                }
                updateBest();
            }

            function loadLeaderboard() {
                if (!window.any2convertLeaderboard) return;
                window.any2convertLeaderboard.fetch("memory_match_game")
                    .then((data) => window.any2convertLeaderboard.render(leaderboardEl, data, {
                        emptyText: "No completed runs yet. Clear the board to set the first record.",
                        loginText: "Log in to save your Memory Match result to the public leaderboard."
                    }))
                    .catch(() => {
                        leaderboardEl.innerHTML = '<div class="rounded-2xl border border-dashed border-slate-200 dark:border-slate-800 px-4 py-5 text-sm text-slate-500 dark:text-slate-400">Could not load the leaderboard right now.</div>';
                    });
            }

            function saveLeaderboardRun() {
                if (!window.any2convertLeaderboard) return;
                window.any2convertLeaderboard.save("memory_match_game", {
                    primary_score: moves,
                    secondary_score: seconds,
                    score_label: `${moves} moves`,
                    score_meta: `${formatTime(seconds)} � ${difficultyEl.options[difficultyEl.selectedIndex].text}`
                }).then(() => loadLeaderboard()).catch(() => loadLeaderboard());
            }

            function startTimer() {
                clearInterval(timer);
                timer = setInterval(() => {
                    seconds += 1;
                    timerEl.textContent = formatTime(seconds);
                }, 1000);
            }

            function stopTimer() {
                clearInterval(timer);
                timer = null;
            }

            function setStatus(message, tone = "default") {
                const tones = {
                    default: "border-fuchsia-200/70 dark:border-fuchsia-500/20 bg-fuchsia-50/80 dark:bg-fuchsia-500/10 text-fuchsia-700 dark:text-fuchsia-200",
                    success: "border-emerald-200/70 dark:border-emerald-500/20 bg-emerald-50/80 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-200",
                    warn: "border-amber-200/70 dark:border-amber-500/20 bg-amber-50/80 dark:bg-amber-500/10 text-amber-700 dark:text-amber-200"
                };
                statusEl.className = `mt-5 rounded-[24px] px-5 py-4 text-sm ${tones[tone] || tones.default}`;
                statusEl.textContent = message;
            }

            function createDeck() {
                const cardCount = parseInt(difficultyEl.value, 10);
                totalPairs = cardCount / 2;
                const source = themes[themeEl.value] || themes.emoji;
                const chosen = source.slice(0, totalPairs);
                return [...chosen, ...chosen]
                    .map((symbol, index) => ({ symbol, id: `${symbol}-${index}-${Math.random().toString(36).slice(2, 7)}` }))
                    .sort(() => Math.random() - 0.5);
            }

            function resetBoardState() {
                firstCard = null;
                lockBoard = false;
                moves = 0;
                matches = 0;
                seconds = 0;
                movesEl.textContent = "0";
                matchesEl.textContent = "0";
                timerEl.textContent = "00:00";
                stopTimer();
                setStatus("Start matching pairs. Every new game shuffles the board.", "default");
            }

            function finishIfDone() {
                if (matches !== totalPairs) return;
                stopTimer();
                saveBest();
                saveLeaderboardRun();
                setStatus(`Board cleared in ${moves} moves and ${formatTime(seconds)}. Hit Start New Game for another shuffle.`, "success");
            }

            function revealCard(button, force = false) {
                if (button.dataset.matched === "1" || (!force && (lockBoard || button.dataset.flipped === "1"))) return;
                button.dataset.flipped = "1";
                button.querySelector("[data-card-front]").style.transform = "rotateY(180deg)";
                button.querySelector("[data-card-back]").style.transform = "rotateY(0deg)";
            }

            function hideCard(button) {
                button.dataset.flipped = "0";
                button.querySelector("[data-card-front]").style.transform = "rotateY(0deg)";
                button.querySelector("[data-card-back]").style.transform = "rotateY(-180deg)";
            }

            function handleCardClick(event) {
                const button = event.currentTarget;
                if (button.dataset.matched === "1" || lockBoard || button === firstCard) return;
                if (!timer) startTimer();
                revealCard(button);

                if (!firstCard) {
                    firstCard = button;
                    setStatus("Nice. Now find its matching pair.", "default");
                    return;
                }

                moves += 1;
                movesEl.textContent = String(moves);

                if (firstCard.dataset.symbol === button.dataset.symbol) {
                    firstCard.dataset.matched = "1";
                    button.dataset.matched = "1";
                    firstCard.classList.add("ring-2","ring-emerald-400/70");
                    button.classList.add("ring-2","ring-emerald-400/70");
                    matches += 1;
                    matchesEl.textContent = String(matches);
                    setStatus("Pair locked in. Keep the streak going.", "success");
                    firstCard = null;
                    finishIfDone();
                    return;
                }

                lockBoard = true;
                setStatus("Not a match. Try to remember their positions.", "warn");
                const previousFirst = firstCard;
                firstCard = null;
                setTimeout(() => {
                    hideCard(previousFirst);
                    hideCard(button);
                    lockBoard = false;
                }, 760);
            }

            function renderBoard() {
                resetBoardState();
                const deck = createDeck();
                board.className = `grid gap-3 ${deck.length >= 20 ? "grid-cols-4 md:grid-cols-5" : "grid-cols-4"}`;
                board.innerHTML = deck.map((card) => `
                    <button type="button" data-symbol="${card.symbol}" data-flipped="0" data-matched="0" class="group relative aspect-square overflow-hidden rounded-[24px] border border-slate-200/80 dark:border-white/10 bg-slate-100 dark:bg-white/[0.03] transition duration-300 hover:-translate-y-1 hover:border-fuchsia-400/40 hover:bg-fuchsia-50 dark:hover:bg-white/[0.05] focus:outline-none focus:ring-2 focus:ring-fuchsia-400/35" style="perspective:1000px;">
                        <span data-card-front class="absolute inset-[1px] rounded-[22px] border border-slate-200 dark:border-white/10 bg-gradient-to-br from-white via-fuchsia-50 to-indigo-50 dark:from-slate-900 dark:via-slate-900 dark:to-slate-800 flex items-center justify-center text-xs font-black uppercase tracking-[0.26em] text-slate-500 dark:text-slate-400 transition duration-500" style="backface-visibility:hidden;-webkit-backface-visibility:hidden;transform:rotateY(0deg);transform-style:preserve-3d;">Flip</span>
                        <span data-card-back class="absolute inset-[1px] rounded-[22px] border border-fuchsia-200 dark:border-fuchsia-400/20 bg-gradient-to-br from-fuchsia-100 via-pink-50 to-indigo-100 dark:from-fuchsia-500/15 dark:via-pink-500/10 dark:to-indigo-500/15 flex items-center justify-center text-4xl transition duration-500" style="backface-visibility:hidden;-webkit-backface-visibility:hidden;transform:rotateY(-180deg);transform-style:preserve-3d;">${card.symbol}</span>
                    </button>
                `).join("");
                board.querySelectorAll("button").forEach((button) => button.addEventListener("click", handleCardClick));
                updateBest();
            }

            document.getElementById("memoryStartBtn").addEventListener("click", renderBoard);
            document.getElementById("memoryPeekBtn").addEventListener("click", () => {
                const cards = Array.from(board.querySelectorAll("button"));
                if (!cards.length || lockBoard) return;
                setStatus("Quick peek activated. Memorize fast.", "warn");
                cards.forEach((card) => revealCard(card, true));
                lockBoard = true;
                setTimeout(() => {
                    cards.forEach((card) => {
                        if (card.dataset.matched !== "1") hideCard(card);
                    });
                    lockBoard = false;
                    setStatus("Peek finished. Start matching.", "default");
                }, 1300);
            });
            difficultyEl.addEventListener("change", renderBoard);
            themeEl.addEventListener("change", renderBoard);
            renderBoard();
            loadLeaderboard();
        })();
    </script>
HTML;
}

function getImageToPdfHTML() {
    return '
    <div class="space-y-6" role="main" aria-label="Image to PDF Converter Tool">
        
        <div style="display:none;">
            <h1>Image to PDF Converter - Convert Image to PDF Online Free</h1>
            <p>Use our free image to pdf converter to add image to pdf without uploading files. Best tool to convert an image to pdf for free download.</p>
        </div>

        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" 
             onclick="document.getElementById(\'imgToPdfInput\').click()" 
             title="Click to convert image to pdf free">
            
            <input type="file" id="imgToPdfInput" class="hidden" accept="image/*" multiple>
            
            <div class="mb-3 flex justify-center text-blue-500">
                <svg width="54" height="54" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                    <circle cx="8.5" cy="10" r="1.5"></circle>
                    <path d="M21 15l-5-5-8 8"></path>
                </svg>
            </div>

            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Image to PDF Converter</h2>
            <p class="font-medium mt-1">Click to select images (JPG, PNG, WEBP)</p>
            <p class="text-sm text-gray-500 mt-2">100% Client-Side | Convert image to pdf free</p>
        </div>

        <div id="imgPreview" class="grid grid-cols-3 gap-2 mt-4"></div>
        
        <button id="convertImagesBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">
            Convert Image to PDF (High Quality)
        </button>

        <footer class="text-center text-xs text-gray-400 mt-2">
            <p>Fastest online image to pdf converter for free. No file upload required.</p>
        </footer>
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
                    // Added alt tag for SEO on preview images
                    div.innerHTML = `<img src="${e.target.result}" class="w-full h-24 object-cover rounded-lg" alt="convert image to pdf"><span class="absolute top-0 right-0 bg-green-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">✓</span>`;
>>>>>>> 1a066413361175037281af2d18e2b6c509191792
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
            // SEO Optimized Filename
            doc.save("Any2Convert-image-to-pdf.pdf");
        });
    </script>';
}
 function getPdfToImageHTML() {

    return '

    <div class="space-y-6">

        <div style="display:none;">
            <h1>PDF to Image Converter - Convert PDF to Image Online Free</h1>
            <p>Best free pdf to image converter to convert pdf to image file. High quality pdf to image free tool online.</p>
        </div>
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'pdfToImgInput\').click()">

            <input type="file" id="pdfToImgInput" class="hidden" accept=".pdf">

            <div class="mb-3 flex justify-center text-blue-500"><svg width="76" height="54" viewBox="0 0 76 54" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M8 9h17l6 6v24a3 3 0 0 1-3 3H8a3 3 0 0 1-3-3V12a3 3 0 0 1 3-3Z"></path><path d="M25 9v8h8"></path><path d="M36 27h12"></path><path d="m43 21 6 6-6 6"></path><rect x="51" y="14" width="20" height="18" rx="3"></rect><circle cx="58" cy="21" r="1.5"></circle><path d="M71 28l-6-6-9 9"></path></svg></div>
<h2 class="text-lg font-semibold">PDF to Image Converter</h2>
            <p class="font-medium">Select PDF to convert to images</p>
            <p class="text-sm text-gray-500 mt-2">Convert pdf to image online free | High-quality JPG</p>
            <p class="text-sm text-gray-900 mt-2">Each page will be converted to high-quality JPG</p>

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
            <div class="text-gray-900" style="font-size: 1px;">
                <h1>PDF to Word Converter - Convert PDF to Word Online Free</h1>
                <p>Looking for a free pdf to word converter? Learn how to convert pdf to word doc easily. High-quality pdf to word free tool with formatting preserved.</p>
            </div>
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'pdfToWordInput\').click()">
            <input type="file" id="pdfToWordInput" class="hidden" accept=".pdf">
            <div class="mb-3 flex justify-center text-blue-500"><svg width="76" height="54" viewBox="0 0 76 54" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M8 9h17l6 6v24a3 3 0 0 1-3 3H8a3 3 0 0 1-3-3V12a3 3 0 0 1 3-3Z"></path><path d="M25 9v8h8"></path><path d="M36 27h12"></path><path d="m43 21 6 6-6 6"></path><path d="M55 17h13"></path><path d="M55 24h13"></path><path d="M55 31h9"></path></svg></div>
           <h2 class="text-lg font-semibold">PDF to Word Converter</h2>
            <p class="font-medium">Select PDF file to convert PDF to Word</p>
            <p class="text-sm text-gray-900 mt-2">Convert PDF to Word Free | Extract PDF to Word DOC</p>
        </div>
        <div id="pdfPreview" class="text-sm text-gray-500 text-center hidden"></div>
        <div class="space-y-4">
            <label class="block text-sm font-medium">Output Format:</label>
            <select id="wordFormat" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                <option value="docx">Word Layout Copy</option>
                <option value="rtf">RTF (Rich Text Format)</option>
                <option value="txt">TXT (Plain Text)</option>
            </select>
        </div>
        <button id="pdfToWordBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Convert PDF to Word (Free Online)</button>
        <div id="wordProgress" class="text-sm text-gray-500 text-center hidden">Processing...</div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script>
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
        // We use quadruple backslashes because this code 
        // lives inside a string returned by another function.
        .split("\\\\").join("\\\\\\\\") 
        .split("{").join("\\\\{")
        .split("}").join("\\\\}")
        .split("\\n\\n").join("\\\\par\\\\par ")
        .split("\\n").join("\\\\line ");
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
                    URL.revokeObjectURL(url);
                }

                alert("Conversion complete! File downloaded.");
            } catch(e) {
                progress.classList.add("text-red-500");
                alert("Error converting PDF: " + e.message);
            }

            progress.classList.add("hidden");
        });
    </script>';
}

function getPdfToPptHTML() {
    return '
    <div class="space-y-6">
     <div style="display:none;">
            <h1>PDF to Word Converter - Convert PDF to PowePoint PPT Online Free</h1>
            <p>Looking for a free pdf to PowePoint PPT converter? Learn how to convert pdf to PowePoint PPT doc easily. High-quality pdf to word free tool with formatting preserved.</p>
        </div>
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'pdfToPptInput\').click()">
            <input type="file" id="pdfToPptInput" class="hidden" accept=".pdf">
            <div class="mb-3 flex justify-center text-blue-500"><svg width="76" height="54" viewBox="0 0 76 54" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M8 9h17l6 6v24a3 3 0 0 1-3 3H8a3 3 0 0 1-3-3V12a3 3 0 0 1 3-3Z"></path><path d="M25 9v8h8"></path><path d="M36 27h12"></path><path d="m43 21 6 6-6 6"></path><path d="M56 34V22"></path><path d="M62 34V18"></path><path d="M68 34V25"></path></svg></div>
            <p class="font-medium">Select PDF to convert to PowerPoint</p>
            <p class="text-sm text-gray-400 mt-2">Each PDF page is placed into PowerPoint as an exact full-slide page image to preserve the original layout</p>
        </div>
        <div id="pdfPreview" class="text-sm text-gray-500 text-center hidden"></div>
        <button id="pdfToPptBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Convert to PowerPoint</button>
                    <p class="font-medium">Select PDF file to convert PDF to Powerpoint</p>
            <p class="text-sm text-gray-900 mt-2">Convert Pdf to Powerpoint Free | Extract PDF to Powerpoint PPT | Best pdf to powerpoint converter</p>

        <div id="pptProgress" class="text-sm text-gray-500 text-center hidden">Processing...</div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pptxgenjs@3.12.0/dist/pptxgen.bundle.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";

        const pdfToPptInput = document.getElementById("pdfToPptInput");
        const pdfPreview = document.getElementById("pdfPreview");
        const pptProgress = document.getElementById("pptProgress");

        pdfToPptInput.addEventListener("change", function() {
            if (!this.files.length) {
                pdfPreview.classList.add("hidden");
                pdfPreview.textContent = "";
                return;
            }

            const file = this.files[0];
            pdfPreview.textContent = file.name + " selected";
            pdfPreview.classList.remove("hidden");
        });

        function fitIntoSlide(pageWidth, pageHeight, slideWidth, slideHeight) {
            const pageRatio = pageWidth / pageHeight;
            const slideRatio = slideWidth / slideHeight;

            let width = slideWidth;
            let height = slideHeight;
            let x = 0;
            let y = 0;

            if (pageRatio > slideRatio) {
                height = slideWidth / pageRatio;
                y = (slideHeight - height) / 2;
            } else {
                width = slideHeight * pageRatio;
                x = (slideWidth - width) / 2;
            }

            return { x, y, width, height };
        }

        document.getElementById("pdfToPptBtn").addEventListener("click", async function() {
            const input = pdfToPptInput;
            if (!input.files.length) return alert("Please select a PDF file");
            pptProgress.classList.remove("hidden");
            
            try {
                const file = input.files[0];
                const arrayBuffer = await file.arrayBuffer();
                const pdf = await pdfjsLib.getDocument({ data: arrayBuffer }).promise;
                const firstPage = await pdf.getPage(1);
                const firstViewport = firstPage.getViewport({ scale: 1 });
                const pptx = new PptxGenJS();
                const baseSlideWidth = 10;
                const baseSlideHeight = baseSlideWidth * (firstViewport.height / firstViewport.width);

                pptx.defineLayout({ name: "PDF_PAGE_LAYOUT", width: baseSlideWidth, height: baseSlideHeight });
                pptx.layout = "PDF_PAGE_LAYOUT";
                pptx.author = "Any2Convert";
                pptx.company = "Any2Convert";
                pptx.subject = "PDF to PowerPoint conversion";
                pptx.title = file.name.replace(/\.pdf$/i, "") || "Converted PDF";

                for (let i = 1; i <= pdf.numPages; i++) {
                    pptProgress.textContent = "Processing page " + i + " of " + pdf.numPages + "...";
                    const page = await pdf.getPage(i);
                    const viewport = page.getViewport({ scale: 2 });
                    const canvas = document.createElement("canvas");
                    const context = canvas.getContext("2d", { alpha: false });

                    canvas.width = Math.ceil(viewport.width);
                    canvas.height = Math.ceil(viewport.height);

                    context.fillStyle = "#FFFFFF";
                    context.fillRect(0, 0, canvas.width, canvas.height);

                    await page.render({
                        canvasContext: context,
                        viewport
                    }).promise;

                    const pageViewport = page.getViewport({ scale: 1 });
                    const bounds = fitIntoSlide(pageViewport.width, pageViewport.height, baseSlideWidth, baseSlideHeight);
                    const slide = pptx.addSlide();
                    slide.background = { color: "FFFFFF" };
                    slide.addImage({
                        data: canvas.toDataURL("image/png"),
                        x: bounds.x,
                        y: bounds.y,
                        w: bounds.width,
                        h: bounds.height
                    });
                }
                
                pptProgress.textContent = "Preparing PowerPoint download...";
                const blob = await pptx.write({ outputType: "blob" });
                const url = URL.createObjectURL(blob);
                const a = document.createElement("a");
                a.href = url;
                a.download = (file.name.replace(/\.pdf$/i, "") || "converted-pdf") + ".pptx";
                a.click();
                URL.revokeObjectURL(url);
                
                alert("Conversion complete! The PowerPoint keeps each PDF page as an exact slide image.");
            } catch(e) {
                alert("Error converting PDF: " + e.message);
            }
            pptProgress.classList.add("hidden");
        });
    </script>';
}

function getPdfToExcelHTML() {
    return '
    <div class="space-y-6">
        <div style="display:none;">
            <h1>PDF to Excel Converter Free - Convert PDF to Excel Online</h1>
            <p>Use this free PDF to Excel converter to convert PDF to Excel, export PDF to Excel spreadsheet files, and learn how to convert a PDF to Excel without losing structure.</p>
            <p>Convert PDF to Excel free with an online PDF to Excel converter, free PDF to Excel converter workflow, and simple steps for converting PDF to Excel spreadsheet data.</p>
        </div>
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'pdfToExcelInput\').click()">
            <input type="file" id="pdfToExcelInput" class="hidden" accept=".pdf">
            <div class="mb-3 flex justify-center text-blue-500"><svg width="76" height="54" viewBox="0 0 76 54" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M8 9h17l6 6v24a3 3 0 0 1-3 3H8a3 3 0 0 1-3-3V12a3 3 0 0 1 3-3Z"></path><path d="M25 9v8h8"></path><path d="M36 27h12"></path><path d="m43 21 6 6-6 6"></path><path d="M55 33 60 27l4 3 6-9"></path></svg></div>
            <h2 class="text-lg font-semibold">PDF to Excel Converter</h2>
            <p class="font-medium">Select PDF to convert PDF to Excel spreadsheet</p>
            <p class="text-sm text-gray-500 mt-2">Convert PDF to Excel free, export PDF to Excel, and organize tables with our online PDF to Excel converter</p>
        </div>
        <div id="pdfPreview" class="text-sm text-gray-500 text-center hidden"></div>
        <div class="space-y-4">
            <label class="block text-sm font-medium">Choose how to convert PDF to Excel:</label>
            <select id="extractMethod" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                <option value="table">PDF to Excel Table Detection (Best for tabular data)</option>
                <option value="text">Convert PDF to Excel Text Extraction</option>
                <option value="lines">Convert a PDF to Excel Line by Line</option>
            </select>
        </div>
        <div class="rounded-2xl border border-blue-100 bg-blue-50/70 dark:bg-blue-950/20 dark:border-blue-900 p-4 text-sm text-blue-900 dark:text-blue-100">
            How to convert PDF to Excel:
            Upload your file, choose the best extraction mode, and convert PDF to Excel online free in seconds.
        </div>
        <button id="pdfToExcelBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Convert PDF to Excel</button>
        <div id="excelProgress" class="text-sm text-gray-500 text-center hidden">Processing...</div>
        <div id="tableResult" class="mt-4 space-y-4"></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";

        const pdfToExcelInput = document.getElementById("pdfToExcelInput");
        const excelPreview = document.getElementById("pdfPreview");
        const excelProgress = document.getElementById("excelProgress");
        const tableResult = document.getElementById("tableResult");

        pdfToExcelInput.addEventListener("change", function() {
            if (!this.files.length) {
                excelPreview.textContent = "";
                excelPreview.classList.add("hidden");
                return;
            }

            excelPreview.textContent = this.files[0].name + " selected";
            excelPreview.classList.remove("hidden");
        });

        function normalizeExcelText(value) {
            return String(value || "")
                .split("\r").join(" ")
                .split("\n").join(" ")
                .split("\t").join(" ")
                .split(" ")
                .filter(Boolean)
                .join(" ")
                .trim();
        }

        function csvEscape(value) {
            return "\"" + String(value == null ? "" : value).replace(/"/g, "\"\"") + "\"";
        }

        function clusterTextRows(items) {
            const positioned = items
                .map(function(item) {
                    return {
                        text: normalizeExcelText(item.str),
                        x: item.transform[4] || 0,
                        y: item.transform[5] || 0,
                        width: item.width || 0,
                        height: Math.abs(item.height || item.transform[0] || 10)
                    };
                })
                .filter(function(item) {
                    return item.text;
                })
                .sort(function(a, b) {
                    if (Math.abs(b.y - a.y) > 2) return b.y - a.y;
                    return a.x - b.x;
                });

            const rows = [];

            positioned.forEach(function(item) {
                const tolerance = Math.max(2.5, item.height * 0.45);
                let row = null;

                for (let i = 0; i < rows.length; i++) {
                    if (Math.abs(rows[i].y - item.y) <= tolerance) {
                        row = rows[i];
                        break;
                    }
                }

                if (!row) {
                    row = { y: item.y, items: [], avgHeight: item.height };
                    rows.push(row);
                }

                row.items.push(item);
                row.avgHeight = (row.avgHeight + item.height) / 2;
            });

            rows.sort(function(a, b) {
                return b.y - a.y;
            });

            return rows.map(function(row) {
                row.items.sort(function(a, b) {
                    return a.x - b.x;
                });
                return row;
            });
        }

        function buildPageLines(rows) {
            return rows.map(function(row) {
                let text = "";
                let lastRight = null;

                row.items.forEach(function(item) {
                    if (lastRight !== null && item.x - lastRight > Math.max(6, item.height * 0.8)) {
                        text += " ";
                    } else if (text) {
                        text += " ";
                    }

                    text += item.text;
                    lastRight = item.x + item.width;
                });

                return normalizeExcelText(text);
            }).filter(Boolean);
        }

        function collectRepeatedMargins(pageRowsCollection) {
            const counts = {};
            const threshold = Math.max(2, Math.ceil(pageRowsCollection.length * 0.6));

            pageRowsCollection.forEach(function(rows) {
                const candidates = [];
                if (rows.length) {
                    candidates.push(buildPageLines([rows[0]])[0] || "");
                }
                if (rows.length > 1) {
                    candidates.push(buildPageLines([rows[1]])[0] || "");
                }
                if (rows.length > 2) {
                    candidates.push(buildPageLines([rows[rows.length - 1]])[0] || "");
                    candidates.push(buildPageLines([rows[rows.length - 2]])[0] || "");
                }

                candidates.forEach(function(text) {
                    const normalized = normalizeExcelText(text);
                    if (!normalized || normalized.length < 2) return;
                    counts[normalized] = (counts[normalized] || 0) + 1;
                });
            });

            const repeated = {};
            Object.keys(counts).forEach(function(key) {
                if (counts[key] >= threshold) {
                    repeated[key] = true;
                }
            });

            return repeated;
        }

        function removeRepeatedMarginRows(rows, repeatedRows) {
            return rows.filter(function(row, index) {
                const text = buildPageLines([row])[0] || "";
                const normalized = normalizeExcelText(text);
                const nearTop = index < 2;
                const nearBottom = index >= rows.length - 2;

                if (!normalized) return false;
                if ((nearTop || nearBottom) && repeatedRows[normalized]) return false;
                return true;
            });
        }

        function buildColumnAnchors(rows) {
            const anchors = [];

            rows.forEach(function(row) {
                row.items.forEach(function(item) {
                    let matched = false;

                    for (let i = 0; i < anchors.length; i++) {
                        if (Math.abs(anchors[i] - item.x) <= Math.max(12, item.height)) {
                            anchors[i] = (anchors[i] + item.x) / 2;
                            matched = true;
                            break;
                        }
                    }

                    if (!matched) anchors.push(item.x);
                });
            });

            return anchors.sort(function(a, b) { return a - b; });
        }

        function rowToCells(row, anchors) {
            const cells = new Array(Math.max(anchors.length, 1)).fill("");

            row.items.forEach(function(item) {
                let closestIndex = 0;
                let closestDistance = Math.abs(item.x - anchors[0]);

                for (let i = 1; i < anchors.length; i++) {
                    const distance = Math.abs(item.x - anchors[i]);
                    if (distance < closestDistance) {
                        closestDistance = distance;
                        closestIndex = i;
                    }
                }

                cells[closestIndex] = cells[closestIndex]
                    ? cells[closestIndex] + " " + item.text
                    : item.text;
            });

            return cells.map(function(cell) {
                return normalizeExcelText(cell);
            });
        }

        function trimEmptyColumns(tableRows) {
            if (!tableRows.length) return tableRows;

            const keep = [];
            const width = Math.max.apply(null, tableRows.map(function(row) { return row.length; }));

            for (let col = 0; col < width; col++) {
                let hasValue = false;
                for (let rowIndex = 0; rowIndex < tableRows.length; rowIndex++) {
                    if (normalizeExcelText(tableRows[rowIndex][col] || "")) {
                        hasValue = true;
                        break;
                    }
                }
                if (hasValue) keep.push(col);
            }

            return tableRows.map(function(row) {
                return keep.map(function(col) {
                    return row[col] || "";
                });
            });
        }

        function buildStructuredTable(textContent) {
            return clusterTextRows(textContent.items || []);
        }

        document.getElementById("pdfToExcelBtn").addEventListener("click", async function() {
            const input = pdfToExcelInput;
            if (!input.files.length) return alert("Please select a PDF file");
            const progress = excelProgress;
            const resultDiv = tableResult;
            progress.classList.remove("hidden");
            resultDiv.innerHTML = "";
            
            try {
                const arrayBuffer = await input.files[0].arrayBuffer();
                const pdf = await pdfjsLib.getDocument({ data: arrayBuffer }).promise;
                const method = document.getElementById("extractMethod").value;
                let allData = [];
                let allText = "";
                const pageRowMaps = [];
                
                for (let i = 1; i <= pdf.numPages; i++) {
                    progress.innerHTML = "Extracting page " + i + " of " + pdf.numPages + "...";
                    const page = await pdf.getPage(i);
                    const textContent = await page.getTextContent({ normalizeWhitespace: true });
                    
                    if (method === "text") {
                        const pageRows = buildStructuredTable(textContent);
                        const pageLines = buildPageLines(pageRows);
                        if (pageLines.length) {
                            allText += pageLines.join("\n") + "\n\n";
                        }
                    } else if (method === "lines") {
                        pageRowMaps.push(buildStructuredTable(textContent));
                    } else {
                        pageRowMaps.push(buildStructuredTable(textContent));
                    }
                }

                if (method === "lines" || method === "table") {
                    const repeatedRows = collectRepeatedMargins(pageRowMaps);
                    const cleanedPageRows = pageRowMaps.map(function(rows) {
                        return removeRepeatedMarginRows(rows, repeatedRows);
                    });

                    if (method === "lines") {
                        cleanedPageRows.forEach(function(rows) {
                            buildPageLines(rows).forEach(function(line) {
                                if (normalizeExcelText(line)) {
                                    allData.push([normalizeExcelText(line)]);
                                }
                            });
                        });
                    } else {
                        const allRows = [];
                        cleanedPageRows.forEach(function(rows) {
                            rows.forEach(function(row) {
                                allRows.push(row);
                            });
                        });

                        const anchors = buildColumnAnchors(allRows);
                        const tableRows = cleanedPageRows.flatMap(function(rows) {
                            return rows.map(function(row) {
                                return rowToCells(row, anchors);
                            });
                        }).filter(function(row) {
                            return row.some(function(cell) { return normalizeExcelText(cell); });
                        });

                        allData = trimEmptyColumns(tableRows);
                    }
                }
                
                let csvContent = "";
                let filename = input.files[0].name.replace(/\.pdf$/i, "") || "extracted_data";
                
                if (method === "text") {
                    const blob = new Blob([allText], { type: "text/plain" });
                    const url = URL.createObjectURL(blob);
                    const a = document.createElement("a");
                    a.href = url;
                    a.download = filename + "_text.txt";
                    a.click();
                    URL.revokeObjectURL(url);
                    resultDiv.innerHTML = "<div class=\"bg-green-100 dark:bg-green-900/30 p-4 rounded-xl text-center\">Text extraction complete! TXT file downloaded.</div>";
                } else if (method === "lines") {
                    csvContent = allData.map(function(row) {
                        return csvEscape(row[0] || "");
                    }).join("\n");
                    const blob = new Blob([csvContent], { type: "text/csv" });
                    const url = URL.createObjectURL(blob);
                    const a = document.createElement("a");
                    a.href = url;
                    a.download = filename + "_lines.csv";
                    a.click();
                    URL.revokeObjectURL(url);
                    resultDiv.innerHTML = "<div class=\"bg-green-100 dark:bg-green-900/30 p-4 rounded-xl text-center\">Line extraction complete! CSV file downloaded.</div>";
                } else {
                    const csvRows = allData.map(function(row) {
                        return row.map(function(cell) {
                            return csvEscape(cell);
                        }).join(",");
                    });
                    csvContent = csvRows.join("\n");
                    const blob = new Blob([csvContent], { type: "text/csv" });
                    const url = URL.createObjectURL(blob);
                    const a = document.createElement("a");
                    a.href = url;
                    a.download = filename + "_table.csv";
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
        <div style="display:none;">
            <h1>Merge PDF Free - Merge PDF Files Online Free</h1>
            <p>Use this free merge PDF tool to merge PDF files, merge PDF online, and learn how to merge PDF files quickly in one secure workflow.</p>
            <p>Merge PDF online free, combine PDF pages in order, and use a free merge PDF experience for personal, school, and office documents.</p>
        </div>
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'mergePdfInput\').click()">
            <input type="file" id="mergePdfInput" class="hidden" accept=".pdf" multiple>
            <div class="mb-3 flex justify-center text-blue-500"><svg width="70" height="54" viewBox="0 0 70 54" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M7 12h14l5 5v19a3 3 0 0 1-3 3H7a3 3 0 0 1-3-3V15a3 3 0 0 1 3-3Z"></path><path d="M21 12v7h7"></path><path d="M50 12h14l5 5v19a3 3 0 0 1-3 3H50a3 3 0 0 1-3-3V15a3 3 0 0 1 3-3Z"></path><path d="M64 12v7h7"></path><path d="M36 20v14"></path><path d="M29 27h14"></path></svg></div>
            <h2 class="text-lg font-semibold">Merge PDF Files</h2>
            <p class="font-medium">Select PDF files to merge PDF online free</p>
            <p class="text-sm text-gray-500 mt-2">Merge PDF free, combine PDF pages in order, and use a simple merge PDF online tool without extra steps</p>
        </div>
        <div id="mergePreview" class="flex flex-wrap gap-2 mt-4"></div>
        <div class="rounded-2xl border border-blue-100 bg-blue-50/70 dark:bg-blue-950/20 dark:border-blue-900 p-4 text-sm text-blue-900 dark:text-blue-100">
            How to merge PDF files:
            Upload two or more files, arrange them if needed, and merge PDF files free in one click.
        </div>
        <button id="mergePdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Merge PDF</button>
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
                badge.innerText = "📄 " + file.name;
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
        <div style="display:none;">
            <h1>Compress PDF Free - Compress PDF Online</h1>
            <p>Use this compress PDF tool to compress PDF online free, reduce PDF file size, and learn how to compress PDF file size while keeping pages readable.</p>
            <p>Compress PDF files, compress PDF file size for free, and optimize documents on Mac, Windows, and mobile browsers.</p>
        </div>
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'compressPdfInput\').click()">
            <input type="file" id="compressPdfInput" class="hidden" accept=".pdf">
            <div class="mb-3 flex justify-center text-blue-500"><svg width="54" height="54" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 10h16"></path><path d="M7 7v10"></path><path d="M12 7v10"></path><path d="M17 7v10"></path><rect x="3" y="5" width="18" height="14" rx="2"></rect></svg></div>
            <h2 class="text-lg font-semibold">Compress PDF File</h2>
            <p class="font-medium">Select PDF to compress PDF file size</p>
            <p class="text-sm text-gray-500 mt-2">Compress PDF online free, reduce PDF file size, and save a smaller document for sharing</p>
        </div>
        <div id="compressPreview" class="text-sm text-gray-500 text-center hidden"></div>
        <div class="space-y-4">
            <label class="block text-sm font-medium">Compression Level:</label>
            <select id="compressLevel" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                <option value="low">Low Compression (Best quality)</option>
                <option value="medium" selected>Medium Compression (Recommended)</option>
                <option value="high">High Compression (Smallest file)</option>
            </select>
        </div>
        <div class="rounded-2xl border border-blue-100 bg-blue-50/70 dark:bg-blue-950/20 dark:border-blue-900 p-4 text-sm text-blue-900 dark:text-blue-100">
            How to compress PDF:
            Upload your file, choose the compression level, and compress PDF for free with a smaller downloadable file.
        </div>
        <button id="compressPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Compress PDF</button>
        <div id="compressProgress" class="text-sm text-gray-500 text-center hidden">Processing...</div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";
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
                const file = input.files[0];
                const arrayBuffer = await file.arrayBuffer();
                const pdf = await pdfjsLib.getDocument({ data: arrayBuffer }).promise;
                const level = document.getElementById("compressLevel").value;
                const settings = {
                    low: { scale: 1.45, quality: 0.88 },
                    medium: { scale: 1.15, quality: 0.72 },
                    high: { scale: 0.9, quality: 0.52 }
                };
                const config = settings[level] || settings.medium;
                const { jsPDF } = window.jspdf;
                let doc = null;

                for (let i = 1; i <= pdf.numPages; i++) {
                    progress.textContent = "Compressing page " + i + " of " + pdf.numPages + "...";
                    const page = await pdf.getPage(i);
                    const viewport = page.getViewport({ scale: config.scale });
                    const canvas = document.createElement("canvas");
                    const context = canvas.getContext("2d", { alpha: false });
                    canvas.width = Math.ceil(viewport.width);
                    canvas.height = Math.ceil(viewport.height);
                    context.fillStyle = "#FFFFFF";
                    context.fillRect(0, 0, canvas.width, canvas.height);

                    await page.render({
                        canvasContext: context,
                        viewport: viewport
                    }).promise;

                    const orientation = viewport.width > viewport.height ? "landscape" : "portrait";
                    const pageFormat = [Math.ceil(viewport.width), Math.ceil(viewport.height)];

                    if (!doc) {
                        doc = new jsPDF({
                            orientation: orientation,
                            unit: "pt",
                            format: pageFormat,
                            compress: true
                        });
                    } else {
                        doc.addPage(pageFormat, orientation);
                    }

                    const imageData = canvas.toDataURL("image/jpeg", config.quality);
                    doc.addImage(imageData, "JPEG", 0, 0, pageFormat[0], pageFormat[1], undefined, "FAST");
                }

                if (!doc) {
                    throw new Error("Could not read any pages from this PDF.");
                }

                progress.textContent = "Preparing compressed PDF...";
                const pdfBytes = doc.output("arraybuffer");
                const blob = new Blob([pdfBytes], { type: "application/pdf" });
                const url = URL.createObjectURL(blob);
                const a = document.createElement("a");
                a.href = url;
                const baseName = file.name.replace(/\.pdf$/i, "") || "compressed";
                a.download = baseName + "-compressed.pdf";
                a.click();
                URL.revokeObjectURL(url);
                
                const originalSize = file.size / 1024;
                const compressedSize = blob.size / 1024;
                const saved = Math.max(0, originalSize - compressedSize);
                const percentSaved = originalSize > 0 ? (saved / originalSize) * 100 : 0;
                alert(
                    "Compression complete!\\nOriginal: " + originalSize.toFixed(2) + " KB\\nCompressed: " + compressedSize.toFixed(2) + " KB\\nSaved: " + saved.toFixed(2) + " KB (" + percentSaved.toFixed(0) + "%)"
                );
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
        <div style="display:none;">
            <h1>Password Protect PDF Online Free</h1>
            <p>Use this password protect PDF tool to protect PDF files online free, add a password to a PDF file, and secure documents from opening, copying, or editing without permission.</p>
            <p>Learn how to password protect PDF files, protect PDF from editing, and create a password protected PDF file in your browser on Mac, Windows, and mobile.</p>
        </div>
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'protectPdfInput\').click()">
            <input type="file" id="protectPdfInput" class="hidden" accept=".pdf">
            <div class="mb-3 flex justify-center text-blue-500"><svg width="54" height="54" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="11" width="14" height="10" rx="2"></rect><path d="M8 11V8a4 4 0 1 1 8 0v3"></path></svg></div>
            <p class="font-medium">Password Protect PDF File</p>
            <p class="text-sm text-gray-500 mt-2">Password protect PDF online free and download a secured copy</p>
        </div>
        <div id="protectPreview" class="text-sm text-gray-500 text-center hidden"></div>
        <div class="space-y-4">
            <label class="block text-sm font-medium">Password:</label>
            <input type="password" id="pdfPassword" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Enter password">
            <label class="block text-sm font-medium">Confirm Password:</label>
            <input type="password" id="confirmPassword" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Confirm password">
        </div>
        <div class="rounded-2xl border border-blue-100 bg-blue-50/70 dark:bg-blue-950/20 dark:border-blue-900 p-4 text-sm text-blue-900 dark:text-blue-100">
            How to password protect PDF:
            Upload the PDF file, enter and confirm a password, protect the PDF from easy access or editing, and download the secured document.
        </div>
        <button id="protectPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Password Protect PDF Free</button>
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
            <div class="mb-3 flex justify-center text-blue-500"><svg width="76" height="54" viewBox="0 0 76 54" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M8 16h13"></path><path d="M8 23h13"></path><path d="M8 30h9"></path><path d="M30 27h12"></path><path d="m37 21 6 6-6 6"></path><path d="M49 9h17l6 6v24a3 3 0 0 1-3 3H49a3 3 0 0 1-3-3V12a3 3 0 0 1 3-3Z"></path><path d="M66 9v8h8"></path></svg></div>
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
            <div class="mb-3 flex justify-center text-blue-500"><svg width="76" height="54" viewBox="0 0 76 54" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M8 34V20"></path><path d="M14 34V14"></path><path d="M20 34V24"></path><path d="M30 27h12"></path><path d="m37 21 6 6-6 6"></path><path d="M49 9h17l6 6v24a3 3 0 0 1-3 3H49a3 3 0 0 1-3-3V12a3 3 0 0 1 3-3Z"></path><path d="M66 9v8h8"></path></svg></div>
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
        <div style="display:none;">
            <h1>Power Point to PDF Converter Online</h1>
            <p>Use this power point to pdf converter to convert PowerPoint slides into PDF online free in your browser.</p>
            <p>Common searches include power point to pdf, convert power point to pdf, power point to pdf conversion, turn power point to pdf, and export power point to pdf.</p>
            <p>If you need microsoft power point to pdf conversion, how to convert power point to pdf, or how to save power point to pdf, this tool helps with PPT and PPTX files.</p>
        </div>
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'pptToPdfInput\').click()">
            <input type="file" id="pptToPdfInput" class="hidden" accept=".ppt,.pptx">
            <div class="mb-3 flex justify-center text-blue-500"><svg width="76" height="54" viewBox="0 0 76 54" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="13" width="18" height="14" rx="2"></rect><path d="m23 18 8-4v12l-8-4"></path><path d="M34 27h12"></path><path d="m41 21 6 6-6 6"></path><path d="M53 9h17l6 6v24a3 3 0 0 1-3 3H53a3 3 0 0 1-3-3V12a3 3 0 0 1 3-3Z"></path><path d="M70 9v8h8"></path></svg></div>
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
        <div class="rounded-2xl border border-blue-100 bg-blue-50/70 dark:bg-blue-950/20 dark:border-blue-900 p-4 text-sm text-blue-900 dark:text-blue-100">This power point to pdf free tool is useful when you want to convert PowerPoint to PDF online, convert from power point to pdf, or save a presentation as a shareable PDF handout.</div>
        <button id="pptToPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Convert to PDF</button>
        <div id="pptProgress" class="text-sm text-gray-500 text-center hidden">Processing...</div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
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
                
                if (/\.pptx$/i.test(file.name)) {
                    try {
                        const JSZip = window.JSZip;
                        const zip = await JSZip.loadAsync(arrayBuffer);
                        const slideFiles = Object.keys(zip.files)
                            .filter(name => /ppt\/slides\/slide\d+\.xml$/i.test(name))
                            .sort(function(a, b) {
                                const aNum = parseInt((a.match(/slide(\d+)\.xml/i) || [0, 0])[1], 10);
                                const bNum = parseInt((b.match(/slide(\d+)\.xml/i) || [0, 0])[1], 10);
                                return aNum - bNum;
                            });

                        function decodeXmlEntities(value) {
                            const textarea = document.createElement("textarea");
                            textarea.innerHTML = value;
                            return textarea.value;
                        }

                        function xmlTextToParagraphs(xmlString) {
                            const lines = [];
                            const paragraphMatches = xmlString.match(/<a:p[\s\S]*?<\/a:p>/gi) || [];

                            paragraphMatches.forEach(function(paragraphXml) {
                                const runMatches = Array.from(paragraphXml.matchAll(/<a:t[^>]*>([\s\S]*?)<\/a:t>/gi));
                                const pieces = runMatches
                                    .map(function(match) { return decodeXmlEntities((match[1] || "").trim()); })
                                    .filter(Boolean);
                                if (pieces.length) {
                                    lines.push(pieces.join(" "));
                                }
                            });

                            if (!lines.length) {
                                const fallbackRuns = Array.from(xmlString.matchAll(/<(?:a:)?t[^>]*>([\s\S]*?)<\/(?:a:)?t>/gi))
                                    .map(function(match) { return decodeXmlEntities((match[1] || "").trim()); })
                                    .filter(Boolean);
                                if (fallbackRuns.length) {
                                    lines.push(fallbackRuns.join(" "));
                                }
                            }

                            return lines;
                        }

                        function normalizeZipPath(basePath, targetPath) {
                            const baseParts = basePath.split("/");
                            baseParts.pop();
                            const targetParts = targetPath.split("/");
                            targetParts.forEach(function(part) {
                                if (!part || part === ".") return;
                                if (part === "..") {
                                    baseParts.pop();
                                } else {
                                    baseParts.push(part);
                                }
                            });
                            return baseParts.join("/");
                        }

                        async function extractSlideImages(slideFile) {
                            const relPath = slideFile.replace(/ppt\/slides\/(slide\d+)\.xml$/i, "ppt/slides/_rels/$1.xml.rels");
                            const relEntry = zip.files[relPath];
                            if (!relEntry) return [];

                            const relXmlText = await relEntry.async("string");
                            const relationships = Array.from(relXmlText.matchAll(/<Relationship\b[^>]*Target="([^"]+)"[^>]*Type="([^"]+)"[^>]*\/?>/gi))
                                .map(function(match) {
                                    return {
                                        target: match[1] || "",
                                        type: match[2] || ""
                                    };
                                });
                            const images = [];

                            for (const rel of relationships) {
                                const target = rel.target || "";
                                const type = rel.type || "";
                                if (!/image/i.test(type) && !/\.(png|jpe?g|gif|bmp|svg|webp)$/i.test(target)) {
                                    continue;
                                }

                                const normalized = normalizeZipPath(relPath, target);
                                const mediaFile = zip.files[normalized];
                                if (!mediaFile) continue;

                                const ext = (normalized.split(".").pop() || "png").toLowerCase();
                                const mimeMap = {
                                    png: "image/png",
                                    jpg: "image/jpeg",
                                    jpeg: "image/jpeg",
                                    gif: "image/gif",
                                    bmp: "image/bmp",
                                    webp: "image/webp",
                                    svg: "image/svg+xml"
                                };
                                const mime = mimeMap[ext] || "application/octet-stream";
                                const base64 = await mediaFile.async("base64");
                                images.push("data:" + mime + ";base64," + base64);
                            }

                            return images;
                        }
                        
                        for (const slideFile of slideFiles) {
                            progress.innerHTML = "Reading " + slideFile.split("/").pop() + "...";
                            const content = await zip.files[slideFile].async("string");
                            const textLines = xmlTextToParagraphs(content);
                            const images = await extractSlideImages(slideFile);

                            slides.push({
                                number: slides.length + 1,
                                lines: textLines,
                                images: images
                            });
                        }

                        if (!slides.length) {
                            throw new Error("No slides were found in this PPTX file.");
                        }
                    } catch(e) {
                        slides.push({
                            number: 1,
                            lines: ["Unable to extract slide content. The presentation may be protected, highly complex, or corrupted."],
                            images: []
                        });
                    }
                } else {
                    slides.push({
                        number: 1,
                        lines: ["Legacy .ppt files are not reliably supported in the browser. Please save the presentation as .pptx and try again for better results."],
                        images: []
                    });
                }
                
                const orientation = layout === "landscape" ? "landscape" : "portrait";
                const { jsPDF } = window.jspdf || {};
                if (!jsPDF) {
                    throw new Error("PDF library failed to load.");
                }

                const pdf = new jsPDF({
                    orientation: orientation,
                    unit: "pt",
                    format: "a4",
                    compress: true
                });

                const pageWidth = pdf.internal.pageSize.getWidth();
                const pageHeight = pdf.internal.pageSize.getHeight();
                const margin = 36;
                const usableWidth = pageWidth - (margin * 2);
                const usableHeight = pageHeight - (margin * 2);

                async function getImageSize(src) {
                    return await new Promise(function(resolve, reject) {
                        const img = new Image();
                        img.onload = function() {
                            resolve({
                                width: img.naturalWidth || img.width || 1,
                                height: img.naturalHeight || img.height || 1
                            });
                        };
                        img.onerror = function() {
                            reject(new Error("Could not read slide image."));
                        };
                        img.src = src;
                    });
                }

                function imageFormatFromDataUrl(src) {
                    if (/^data:image\/png/i.test(src)) return "PNG";
                    if (/^data:image\/webp/i.test(src)) return "WEBP";
                    if (/^data:image\/svg\+xml/i.test(src)) return "SVG";
                    return "JPEG";
                }

                for (let i = 0; i < slides.length; i++) {
                    if (i > 0) {
                        pdf.addPage("a4", orientation);
                    }

                    progress.innerHTML = "Building PDF page " + (i + 1) + " of " + slides.length + "...";
                    const slide = slides[i];
                    let cursorY = margin;

                    pdf.setFillColor(255, 255, 255);
                    pdf.rect(0, 0, pageWidth, pageHeight, "F");

                    pdf.setDrawColor(52, 152, 219);
                    pdf.setLineWidth(4);
                    pdf.line(margin, cursorY, margin, cursorY + 28);
                    pdf.setFont("helvetica", "bold");
                    pdf.setTextColor(30, 41, 59);
                    pdf.setFontSize(20);
                    pdf.text("Slide " + slide.number, margin + 12, cursorY + 20);
                    cursorY += 42;

                    const textLines = (slide.lines || []).length ? slide.lines : ["No readable text was found on this slide."];
                    pdf.setFont("helvetica", "normal");
                    pdf.setTextColor(51, 65, 85);
                    pdf.setFontSize(12);

                    textLines.forEach(function(line) {
                        const wrapped = pdf.splitTextToSize(String(line || ""), usableWidth);
                        if (cursorY + (wrapped.length * 16) > pageHeight - margin) {
                            return;
                        }
                        pdf.text(wrapped, margin, cursorY);
                        cursorY += (wrapped.length * 16) + 6;
                    });

                    for (const src of (slide.images || [])) {
                        try {
                            const size = await getImageSize(src);
                            const maxWidth = usableWidth;
                            const maxHeight = Math.max(80, pageHeight - margin - cursorY);
                            const scale = Math.min(maxWidth / size.width, maxHeight / size.height, 1);
                            const renderWidth = Math.max(40, size.width * scale);
                            const renderHeight = Math.max(40, size.height * scale);

                            if (cursorY + renderHeight > pageHeight - margin) {
                                break;
                            }

                            const x = margin + ((usableWidth - renderWidth) / 2);
                            pdf.addImage(src, imageFormatFromDataUrl(src), x, cursorY, renderWidth, renderHeight);
                            cursorY += renderHeight + 18;
                        } catch (imageError) {
                        }
                    }
                }

                pdf.save((file.name.replace(/\.(ppt|pptx)$/i, "") || "presentation") + ".pdf");
                alert("Conversion complete! PDF downloaded.");
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
        <div style="display:none;">
            <h1>JSON to CSV Converter Online</h1>
            <p>Convert JSON to CSV online, convert JSON to CSV format for Excel, and download spreadsheet-ready files in your browser.</p>
            <p>Useful for developers, analysts, Python JSON to CSV workflows, PowerShell convert JSON to CSV tasks, and data exports.</p>
        </div>
        <div class="grid 2xl:grid-cols-[1.05fr_0.95fr] gap-6">
            <div class="rounded-[2rem] border border-slate-200/80 dark:border-slate-700/70 bg-gradient-to-br from-white via-blue-50/70 to-cyan-50/70 dark:from-slate-900 dark:via-slate-900 dark:to-slate-950 p-6 shadow-[0_24px_70px_rgba(15,23,42,0.08)]">
                <div class="flex items-start justify-between gap-4 mb-5">
                    <div>
                        <p class="text-[11px] font-black uppercase tracking-[0.22em] text-blue-600 dark:text-blue-400">JSON to CSV / Excel</p>
                        <h3 class="text-2xl font-black text-gray-900 dark:text-white mt-2">Convert JSON into CSV or Excel-ready rows</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-3 max-w-2xl">Paste JSON, upload a `.json` file, flatten nested objects, preview the table, and download CSV or Excel output. Great for data scientists, analysts, and developers.</p>
                    </div>
                    <div class="hidden sm:flex items-center justify-center w-14 h-14 rounded-2xl bg-blue-600/10 text-blue-600 dark:bg-blue-500/15 dark:text-blue-300 text-xl">{ }</div>
                </div>

                <input type="file" id="jsonFileInput" accept=".json,application/json" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-2xl border border-gray-200 dark:border-gray-600">
                <textarea id="jsonInput" class="w-full h-72 mt-4 p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-2xl font-mono text-sm border border-gray-200 dark:border-gray-600" placeholder=\'[{"name":"John","age":30,"address":{"city":"Lahore"}},{"name":"Jane","age":25,"address":{"city":"Karachi"}}]\'></textarea>

                <div class="mt-5 flex flex-wrap gap-3">
                    <button id="jsonToCsvBtn" type="button" class="px-5 py-3 rounded-2xl bg-blue-600 text-white font-bold hover:bg-blue-700 transition">Convert JSON to CSV</button>
                    <button id="downloadCsvBtn" type="button" class="px-5 py-3 rounded-2xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition hidden">Download CSV</button>
                    <button id="downloadExcelBtn" type="button" class="px-5 py-3 rounded-2xl bg-amber-500 text-slate-950 font-semibold hover:bg-amber-400 transition hidden">Download Excel</button>
                </div>

                <p id="jsonToCsvStatus" class="text-sm text-gray-500 dark:text-gray-400 mt-4">Convert JSON to CSV online or prepare JSON data for Excel with one click.</p>
            </div>

            <div class="rounded-[2rem] border border-slate-200/80 dark:border-slate-700/70 bg-gradient-to-br from-slate-50 via-white to-blue-50/50 dark:from-slate-950 dark:via-slate-950 dark:to-slate-900 p-6">
                <p class="text-[11px] font-black uppercase tracking-[0.22em] text-blue-600 dark:text-blue-400">Preview</p>
                <div class="mt-4 rounded-[1.8rem] bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 shadow-sm">
                    <pre id="csvPreview" class="text-xs overflow-x-auto whitespace-pre-wrap text-gray-700 dark:text-slate-100 min-h-[260px]">CSV preview will appear here after conversion.</pre>
                </div>
                <div class="mt-4 grid sm:grid-cols-2 gap-3">
                    <div class="rounded-[1.4rem] border border-slate-200/80 dark:border-slate-700/80 bg-white/85 dark:bg-slate-950/70 p-4">
                        <p class="text-[11px] font-black uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400">Good for</p>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300 leading-6">API responses, analytics exports, Python JSON to CSV tasks, PowerShell conversions, and convert JSON to CSV in Excel workflows.</p>
                    </div>
                    <div class="rounded-[1.4rem] border border-slate-200/80 dark:border-slate-700/80 bg-white/85 dark:bg-slate-950/70 p-4">
                        <p class="text-[11px] font-black uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400">Output</p>
                        <p id="jsonToCsvMeta" class="mt-2 text-sm text-gray-600 dark:text-gray-300 leading-6">No output yet. Paste JSON and run the converter.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
    <script>
        let currentCSV = "";
        let currentRows = [];
        const jsonInput = document.getElementById("jsonInput");
        const jsonStatus = document.getElementById("jsonToCsvStatus");
        const csvPreview = document.getElementById("csvPreview");
        const jsonMeta = document.getElementById("jsonToCsvMeta");
        const downloadCsvBtn = document.getElementById("downloadCsvBtn");
        const downloadExcelBtn = document.getElementById("downloadExcelBtn");

        function setJsonStatus(message, isError) {
            jsonStatus.textContent = message || "";
            jsonStatus.classList.toggle("text-red-500", !!isError);
            jsonStatus.classList.toggle("dark:text-red-400", !!isError);
            if (!isError) {
                jsonStatus.classList.remove("text-red-500", "dark:text-red-400");
            }
        }

        function flattenObject(value, prefix, output) {
            if (Array.isArray(value)) {
                if (!value.length) {
                    output[prefix] = "";
                    return;
                }
                const primitiveArray = value.every(function(item) {
                    return item === null || ["string", "number", "boolean"].includes(typeof item);
                });
                if (primitiveArray) {
                    output[prefix] = value.join(" | ");
                    return;
                }
                output[prefix] = JSON.stringify(value);
                return;
            }

            if (value && typeof value === "object") {
                Object.keys(value).forEach(function(key) {
                    const nextKey = prefix ? prefix + "." + key : key;
                    flattenObject(value[key], nextKey, output);
                });
                return;
            }

            output[prefix] = value === null || value === undefined ? "" : value;
        }

        function normalizeRows(parsed) {
            if (Array.isArray(parsed)) return parsed;
            if (parsed && typeof parsed === "object") return [parsed];
            throw new Error("JSON must be an object or array of objects.");
        }

        document.getElementById("jsonFileInput").addEventListener("change", function() {
            const file = this.files && this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                jsonInput.value = e.target.result || "";
                setJsonStatus("JSON file loaded. Click convert to generate CSV or Excel.");
            };
            reader.readAsText(file);
        });
        
        document.getElementById("jsonToCsvBtn").addEventListener("click", function() {
            try {
                const parsed = JSON.parse(jsonInput.value);
                const rows = normalizeRows(parsed);
                if (!rows.length) throw new Error("JSON array is empty.");

                currentRows = rows.map(function(row) {
                    if (!row || typeof row !== "object" || Array.isArray(row)) {
                        return { value: JSON.stringify(row) };
                    }
                    const flattened = {};
                    Object.keys(row).forEach(function(key) {
                        flattenObject(row[key], key, flattened);
                    });
                    return flattened;
                });

                const worksheet = XLSX.utils.json_to_sheet(currentRows);
                currentCSV = XLSX.utils.sheet_to_csv(worksheet);
                csvPreview.textContent = currentCSV || "No CSV output generated.";
                jsonMeta.textContent = currentRows.length + " row(s) prepared with " + Object.keys(currentRows[0] || {}).length + " column(s). Ready for CSV or Excel download.";
                downloadCsvBtn.classList.remove("hidden");
                downloadExcelBtn.classList.remove("hidden");
                setJsonStatus("JSON converted successfully. Download CSV or Excel.");
            } catch (e) {
                currentCSV = "";
                currentRows = [];
                downloadCsvBtn.classList.add("hidden");
                downloadExcelBtn.classList.add("hidden");
                csvPreview.textContent = "CSV preview will appear here after conversion.";
                jsonMeta.textContent = "No output yet. Paste JSON and run the converter.";
                setJsonStatus("Invalid JSON: " + e.message, true);
            }
        });
        
        downloadCsvBtn.addEventListener("click", function() {
            if (!currentCSV) return;
            const blob = new Blob([currentCSV], { type: "text/csv" });
            const url = URL.createObjectURL(blob);
            const a = document.createElement("a");
            a.href = url;
            a.download = "converted.csv";
            a.click();
            URL.revokeObjectURL(url);
        });

        downloadExcelBtn.addEventListener("click", function() {
            if (!currentRows.length || !window.XLSX) return;
            const worksheet = XLSX.utils.json_to_sheet(currentRows);
            const workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, "JSON");
            XLSX.writeFile(workbook, "converted.xlsx");
        });
    </script>';
}

function getCsvToJsonHTML() {
    return '
    <div class="space-y-6">
        <div class="rounded-2xl border border-blue-200/70 bg-blue-50/80 dark:bg-blue-950/30 dark:border-blue-900 p-4">
            <div class="font-semibold text-blue-900 dark:text-blue-100">Paste CSV or upload a file</div>
            <p class="mt-1 text-sm text-blue-800 dark:text-blue-200">Upload a `.csv` file or paste CSV text below to convert it into JSON.</p>
        </div>
        <input type="file" id="csvFileInput" accept=".csv,text/csv" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
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
        document.getElementById("csvFileInput").addEventListener("change", function() {
            const file = this.files && this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("csvInput").value = e.target.result || "";
            };
            reader.readAsText(file);
        });
        
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

function getSqlToJsonHTML() {
    return '
    <div class="space-y-6">
        <div style="display:none;">
            <h1>SQL to JSON Converter Online</h1>
            <p>Convert SQL to JSON online, parse SQL INSERT statements, and export database rows into JSON for development and database management.</p>
        </div>
        <div class="grid 2xl:grid-cols-[1.05fr_0.95fr] gap-6">
            <div class="rounded-[2rem] border border-slate-200/80 dark:border-slate-700/70 bg-gradient-to-br from-white via-blue-50/70 to-cyan-50/70 dark:from-slate-900 dark:via-slate-900 dark:to-slate-950 p-6 shadow-[0_24px_70px_rgba(15,23,42,0.08)]">
                <div class="flex items-start justify-between gap-4 mb-5">
                    <div>
                        <p class="text-[11px] font-black uppercase tracking-[0.22em] text-blue-600 dark:text-blue-400">SQL to JSON</p>
                        <h3 class="text-2xl font-black text-gray-900 dark:text-white mt-2">Convert SQL INSERT rows into clean JSON</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-3 max-w-2xl">Paste SQL dump content with `INSERT INTO ... VALUES (...)` statements and convert it into JSON objects for APIs, apps, testing, and database management.</p>
                    </div>
                    <div class="hidden sm:flex items-center justify-center w-14 h-14 rounded-2xl bg-blue-600/10 text-blue-600 dark:bg-blue-500/15 dark:text-blue-300 text-xl">SQL</div>
                </div>

                <textarea id="sqlToJsonInput" class="w-full h-72 p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-2xl font-mono text-sm border border-gray-200 dark:border-gray-600" placeholder="INSERT INTO users (id, name, email) VALUES (1, &quot;Ali&quot;, &quot;ali@example.com&quot;), (2, &quot;Sara&quot;, &quot;sara@example.com&quot;);"></textarea>

                <div class="mt-5 flex flex-wrap gap-3">
                    <button id="sqlToJsonBtn" type="button" class="px-5 py-3 rounded-2xl bg-blue-600 text-white font-bold hover:bg-blue-700 transition">Convert SQL to JSON</button>
                    <button id="copySqlJsonBtn" type="button" class="px-5 py-3 rounded-2xl bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-100 font-semibold hover:bg-slate-200 dark:hover:bg-slate-700 transition hidden">Copy JSON</button>
                    <button id="downloadSqlJsonBtn" type="button" class="px-5 py-3 rounded-2xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition hidden">Download JSON</button>
                </div>

                <p id="sqlToJsonStatus" class="text-sm text-gray-500 dark:text-gray-400 mt-4">Best for SQL to JSON conversion from INSERT statements and SQL dump samples.</p>
            </div>

            <div class="rounded-[2rem] border border-slate-200/80 dark:border-slate-700/70 bg-gradient-to-br from-slate-50 via-white to-blue-50/50 dark:from-slate-950 dark:via-slate-950 dark:to-slate-900 p-6">
                <p class="text-[11px] font-black uppercase tracking-[0.22em] text-blue-600 dark:text-blue-400">JSON Output</p>
                <div class="mt-4 rounded-[1.8rem] bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 shadow-sm">
                    <textarea id="sqlToJsonOutput" class="w-full h-72 bg-transparent text-sm leading-7 text-gray-800 dark:text-slate-100 resize-none outline-none" placeholder="Converted JSON will appear here."></textarea>
                </div>
                <div class="mt-4 grid sm:grid-cols-2 gap-3">
                    <div class="rounded-[1.4rem] border border-slate-200/80 dark:border-slate-700/80 bg-white/85 dark:bg-slate-950/70 p-4">
                        <p class="text-[11px] font-black uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400">Supported</p>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300 leading-6">Standard `INSERT INTO table (columns) VALUES (...)` statements with multiple rows.</p>
                    </div>
                    <div class="rounded-[1.4rem] border border-slate-200/80 dark:border-slate-700/80 bg-white/85 dark:bg-slate-950/70 p-4">
                        <p class="text-[11px] font-black uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400">Use cases</p>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300 leading-6">Database management, API seeding, fixtures, migrations, quick data cleanup, and SQL to JSON online checks.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const sqlToJsonInput = document.getElementById("sqlToJsonInput");
        const sqlToJsonOutput = document.getElementById("sqlToJsonOutput");
        const sqlToJsonStatus = document.getElementById("sqlToJsonStatus");
        const copySqlJsonBtn = document.getElementById("copySqlJsonBtn");
        const downloadSqlJsonBtn = document.getElementById("downloadSqlJsonBtn");

        function setSqlJsonStatus(message, isError) {
            sqlToJsonStatus.textContent = message || "";
            sqlToJsonStatus.classList.toggle("text-red-500", !!isError);
            sqlToJsonStatus.classList.toggle("dark:text-red-400", !!isError);
            if (!isError) {
                sqlToJsonStatus.classList.remove("text-red-500", "dark:text-red-400");
            }
        }

        function splitSqlValues(rowText) {
            const values = [];
            let current = "";
            let quote = "";
            let depth = 0;

            for (let i = 0; i < rowText.length; i++) {
                const char = rowText[i];
                const next = rowText[i + 1] || "";

                if (quote) {
                    current += char;
                    if (char === "\\\\") {
                        current += next;
                        i++;
                        continue;
                    }
                    if (char === quote) {
                        quote = "";
                    }
                    continue;
                }

                if (char === "\\"" || char === "\'") {
                    quote = char;
                    current += char;
                    continue;
                }

                if (char === "(") depth++;
                if (char === ")") depth--;

                if (char === "," && depth === 0) {
                    values.push(current.trim());
                    current = "";
                    continue;
                }

                current += char;
            }

            if (current.trim() !== "") {
                values.push(current.trim());
            }
            return values;
        }

        function parseSqlValue(raw) {
            const value = String(raw || "").trim();
            if (/^null$/i.test(value)) return null;
            if (/^(true|false)$/i.test(value)) return /^true$/i.test(value);
            if (/^-?\d+(\.\d+)?$/.test(value)) return Number(value);
            if ((value.startsWith("\'") && value.endsWith("\'")) || (value.startsWith("\\"") && value.endsWith("\\""))) {
                return value.slice(1, -1).replace(/\\\\\'/g, "\'").replace(/\\\\\\"/g, "\\"").replace(/\\\\n/g, "\n").replace(/\\\\r/g, "\r").replace(/\\\\t/g, "\t").replace(/\\\\\\\\/g, "\\\\");
            }
            return value;
        }

        function extractRows(valuesSection) {
            const rows = [];
            let current = "";
            let depth = 0;
            let quote = "";

            for (let i = 0; i < valuesSection.length; i++) {
                const char = valuesSection[i];
                const next = valuesSection[i + 1] || "";

                if (quote) {
                    current += char;
                    if (char === "\\\\") {
                        current += next;
                        i++;
                        continue;
                    }
                    if (char === quote) {
                        quote = "";
                    }
                    continue;
                }

                if (char === "\\"" || char === "\'") {
                    quote = char;
                    current += char;
                    continue;
                }

                if (char === "(") {
                    depth++;
                    if (depth === 1) continue;
                }

                if (char === ")") {
                    depth--;
                    if (depth === 0) {
                        rows.push(current);
                        current = "";
                        continue;
                    }
                }

                if (depth >= 1) {
                    current += char;
                }
            }

            return rows;
        }

        function parseInsertStatements(sql) {
            const regex = /INSERT\\s+INTO\\s+[`"\\w.]+\\s*\\(([^)]+)\\)\\s*VALUES\\s*([\\s\\S]*?);/gi;
            const output = [];
            let match;

            while ((match = regex.exec(sql)) !== null) {
                const columns = match[1].split(",").map(function(column) {
                    return column.trim().replace(/^[`"\\[]+|[`"\\]]+$/g, "");
                });
                const rows = extractRows(match[2]);

                rows.forEach(function(rowText) {
                    const values = splitSqlValues(rowText);
                    const item = {};
                    columns.forEach(function(column, index) {
                        item[column] = parseSqlValue(values[index] || "");
                    });
                    output.push(item);
                });
            }

            return output;
        }

        document.getElementById("sqlToJsonBtn").addEventListener("click", function() {
            try {
                const sql = sqlToJsonInput.value.trim();
                if (!sql) throw new Error("Please paste SQL INSERT statements first.");
                const rows = parseInsertStatements(sql);
                if (!rows.length) throw new Error("No supported INSERT INTO ... VALUES statements were found.");
                sqlToJsonOutput.value = JSON.stringify(rows, null, 2);
                copySqlJsonBtn.classList.remove("hidden");
                downloadSqlJsonBtn.classList.remove("hidden");
                setSqlJsonStatus("SQL converted successfully. " + rows.length + " row(s) exported to JSON.");
            } catch (error) {
                sqlToJsonOutput.value = "";
                copySqlJsonBtn.classList.add("hidden");
                downloadSqlJsonBtn.classList.add("hidden");
                setSqlJsonStatus(error.message, true);
            }
        });

        copySqlJsonBtn.addEventListener("click", async function() {
            if (!sqlToJsonOutput.value.trim()) return;
            try {
                await navigator.clipboard.writeText(sqlToJsonOutput.value);
                setSqlJsonStatus("JSON copied to clipboard.");
            } catch (error) {
                setSqlJsonStatus("Could not copy automatically. Please copy the JSON manually.", true);
            }
        });

        downloadSqlJsonBtn.addEventListener("click", function() {
            if (!sqlToJsonOutput.value.trim()) return;
            const blob = new Blob([sqlToJsonOutput.value], { type: "application/json;charset=utf-8" });
            const url = URL.createObjectURL(blob);
            const link = document.createElement("a");
            link.href = url;
            link.download = "converted.json";
            link.click();
            URL.revokeObjectURL(url);
        });
    </script>';
}

function getQrGeneratorHTML() {
    return '
    <div class="space-y-6">
        <div style="display:none;">
            <h1>Free QR Code Generator Online</h1>
            <p>Use this QR code generator free tool to create static QR codes for URLs, text, WiFi, business cards, and more.</p>
            <p>Best free QR code generator, online QR code generator, free QR code generator no sign up, and QR code generator free online workflow in your browser.</p>
            <p>If you are comparing Adobe QR code generator, Canva QR code generator, Google QR code generator, or the QR code generator tools online, this gives you a privacy-first free option.</p>
        </div>
        <div class="rounded-2xl border border-blue-200/70 bg-blue-50/80 dark:bg-blue-950/30 dark:border-blue-900 p-4">
            <div class="font-semibold text-blue-900 dark:text-blue-100">Free QR Code Generator</div>
            <p class="mt-1 text-sm text-blue-800 dark:text-blue-200">Create a QR code instantly with this free QR code generator online. No sign up, no expiry, and instant PNG download.</p>
        </div>
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
        <div class="rounded-2xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/60 p-4 text-sm text-gray-600 dark:text-gray-300">This QR code generator free tool works well for website links, menus, contact cards, plain text, and quick sharing. It is a free QR code generator online with no sign up requirement for basic static codes.</div>
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
        <div style="display:none;">
            <h1>Password Generator Free Online</h1>
            <p>Use this password generator to create a strong password, secure password, or random password generator result directly in your browser.</p>
            <p>Generate a password with 8, 12, 14, 15, or 16 characters using this strong random password generator free tool.</p>
            <p>If you need a password generator online, random password generator, or strong password generator for safer accounts, this tool helps instantly.</p>
        </div>
        <div class="rounded-2xl border border-blue-200/70 bg-blue-50/80 dark:bg-blue-950/30 dark:border-blue-900 p-4">
            <div class="font-semibold text-blue-900 dark:text-blue-100">Strong Password Generator</div>
            <p class="mt-1 text-sm text-blue-800 dark:text-blue-200">Create a secure password, random password, or strong password generator result with adjustable length and character types.</p>
        </div>
        <div class="flex flex-wrap gap-6 mb-4">
            <label class="flex items-center gap-2"><input type="radio" name="passType" value="strong" checked> <span>Strong (letters+numbers+symbols)</span></label>
            <label class="flex items-center gap-2"><input type="radio" name="passType" value="numbers"> <span>Numbers Only</span></label>
            <label class="flex items-center gap-2"><input type="radio" name="passType" value="alphanumeric"> <span>Alphanumeric (A-Z, 0-9)</span></label>
        </div>
        <div class="space-y-4">
            <label class="block text-sm font-medium">Password Length: <span id="lengthValue">16</span></label>
            <input type="range" id="passLength" min="6" max="32" value="16" class="w-full">
        </div>
        <div class="rounded-2xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/60 p-4 text-sm text-gray-600 dark:text-gray-300">Use this password generator free tool to create a password generator 12 characters result, a password generator 15 characters result, or a strong random password generator output for your accounts.</div>
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
            <div class="mb-3 flex justify-center text-blue-500"><svg width="68" height="54" viewBox="0 0 68 54" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="10" width="26" height="20" rx="3"></rect><circle cx="12" cy="18" r="1.6"></circle><path d="M30 25l-7-7-11 11"></path><path d="M42 16h18"></path><path d="M42 23h14"></path><path d="M42 30h10"></path></svg></div>
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
            <div class="mb-3 flex justify-center text-blue-500"><svg width="54" height="54" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20c4-1 6-3 8-7"></path><path d="M14 4c3 0 6 3 6 6 0 6-6 10-12 10H4v-4C4 10 8 4 14 4Z"></path><path d="M14 10h.01"></path></svg></div>
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
            <div class="mb-3 flex justify-center text-blue-500"><svg width="54" height="54" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19 19 4"></path><path d="M5 8V4h4"></path><path d="M15 20h5v-5"></path><path d="M8 21h8"></path></svg></div>
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
                imgToDxfMeta.innerText = file.name + " • " + Math.round(file.size / 1024) + " KB";
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
                    imgToDxfStatus.innerText = "DXF ready. Generated " + lines.length + " line segments from a " + width + " x " + height + " trace.";
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
                document.getElementById("imgToSvgMeta").innerText = file.name + " • " + Math.round(file.size / 1024) + " KB";
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
                    document.getElementById("resizeOriginalMeta").innerText = img.width + " x " + img.height + " • " + Math.round(file.size / 1024) + " KB";
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
                        document.getElementById("resizeResultMeta").innerText = width + " x " + height + " • " + Math.round(blob.size / 1024) + " KB";
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
            <div class="mb-3 flex justify-center text-blue-500"><svg width="54" height="54" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3 1.8 4.2L18 9l-4.2 1.8L12 15l-1.8-4.2L6 9l4.2-1.8L12 3Z"></path><path d="m19 15 .8 1.9 1.9.8-1.9.8-.8 1.9-.8-1.9-1.9-.8 1.9-.8.8-1.9Z"></path><path d="m5 14 1.1 2.6L8.7 17l-2.6 1.1L5 20.7l-1.1-2.6L1.3 17l2.6-1.1L5 14Z"></path></svg></div>
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
            <div class="mb-3 flex justify-center text-blue-500"><svg width="54" height="54" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21c4.97 0 9-3.58 9-8 0-3.87-3.09-7.09-7.2-7.82A8 8 0 1 0 12 21Z"></path><circle cx="7.5" cy="11.5" r="1"></circle><circle cx="11" cy="7.5" r="1"></circle><circle cx="16.5" cy="10.5" r="1"></circle><path d="M15 15c.8 2.2-1.3 4-3.5 4"></path></svg></div>
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
                    showStatus("🎨 Generating your image... This may take a few seconds.");
                    
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
                    showStatus("❌ " + error.message, true);
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
                        originalMeta.textContent = img.width + " x " + img.height + " • " + Math.round(file.size / 1024) + " KB";
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
                            resultMeta.textContent = img.width + " x " + img.height + " • " + Math.round(blob.size / 1024) + " KB";
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

function getHeicConverterHTML() {
    return '
    <div class="space-y-6">
        <div style="display:none;">
            <h1>HEIC to JPG PNG PDF Converter Online Free</h1>
            <p>Use this HEIC to JPG converter to convert HEIC to JPG free, change HEIC to JPEG, convert HEIC to PNG, or export HEIC images as PDF directly in your browser.</p>
            <p>Free HEIC to JPG converter, HEIC to JPEG converter, and HEIC to PNG converter for Windows, Mac, and iPhone workflows without uploading files to a server.</p>
        </div>
        <div class="rounded-2xl border border-cyan-200/70 bg-cyan-50/80 dark:bg-cyan-950/30 dark:border-cyan-900 p-4">
            <div class="font-semibold text-cyan-900 dark:text-cyan-100">HEIC Converter</div>
            <p class="mt-1 text-sm text-cyan-800 dark:text-cyan-200">Upload a HEIC image, choose JPG, JPEG, PNG, or PDF style export, preview it, and download the converted file.</p>
        </div>
        <div class="rounded-2xl border border-gray-200 dark:border-gray-700 p-5 space-y-4 bg-white dark:bg-gray-900">
            <input type="file" id="heicInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".heic,.heif,image/heic,image/heif">
            <select id="heicOutputFormat" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                <option value="jpg">Convert to JPG</option>
                <option value="png">Convert to PNG</option>
                <option value="pdf">Convert to PDF</option>
            </select>
            <div class="rounded-2xl border border-blue-100 bg-blue-50/70 dark:bg-blue-950/20 dark:border-blue-900 p-4 text-sm text-blue-900 dark:text-blue-100">
                How to convert HEIC to JPG, JPEG, or PNG:
                Upload the HEIC file, choose the output format, and download the converted image or PDF in seconds.
            </div>
            <button id="heicConvertBtn" class="w-full bg-cyan-600 text-white py-3 rounded-xl font-semibold hover:bg-cyan-700 transition">Convert HEIC to JPG PNG PDF</button>
            <div id="heicStatus" class="hidden text-sm text-gray-500 text-center"></div>
        </div>
        <div class="rounded-3xl border border-gray-200 dark:border-gray-700 bg-slate-50 dark:bg-slate-950/40 p-4">
            <div class="text-sm text-gray-500 mb-3">Preview</div>
            <div id="heicPreviewWrap" class="rounded-2xl border border-dashed border-gray-300 dark:border-gray-700 p-8 text-center text-sm text-gray-500 min-h-[260px] flex items-center justify-center">Converted HEIC preview will appear here.</div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/heic2any@0.0.4/dist/heic2any.min.js"></script>
    <script>
        const heicInput = document.getElementById("heicInput");
        const heicOutputFormat = document.getElementById("heicOutputFormat");
        const heicConvertBtn = document.getElementById("heicConvertBtn");
        const heicStatus = document.getElementById("heicStatus");
        const heicPreviewWrap = document.getElementById("heicPreviewWrap");

        function setHeicStatus(message, isError) {
            if (!message) {
                heicStatus.textContent = "";
                heicStatus.classList.add("hidden");
                heicStatus.classList.remove("text-red-500");
                return;
            }

            heicStatus.textContent = message;
            heicStatus.classList.remove("hidden");
            heicStatus.classList.toggle("text-red-500", !!isError);
        }

        function getHeicBaseName(name) {
            let base = name || "converted";
            base = base.replace(/\\.(heic|heif)$/i, "");
            return base || "converted";
        }

        async function blobToImage(blob) {
            return new Promise(function(resolve, reject) {
                const url = URL.createObjectURL(blob);
                const image = new Image();
                image.onload = function() {
                    URL.revokeObjectURL(url);
                    resolve(image);
                };
                image.onerror = function() {
                    URL.revokeObjectURL(url);
                    reject(new Error("Could not load converted image preview."));
                };
                image.src = url;
            });
        }

        async function renderHeicPreview(blob) {
            const image = await blobToImage(blob);
            heicPreviewWrap.innerHTML = "";
            image.className = "max-w-full max-h-[520px] mx-auto rounded-xl shadow";
            heicPreviewWrap.appendChild(image);
        }

        heicConvertBtn.addEventListener("click", async function() {
            const file = heicInput.files && heicInput.files[0] ? heicInput.files[0] : null;
            if (!file) {
                alert("Please select a HEIC file");
                return;
            }

            try {
                heicConvertBtn.disabled = true;
                heicConvertBtn.textContent = "Converting...";
                setHeicStatus("Converting HEIC file. Please wait...");
                const targetFormat = heicOutputFormat.value;
                const imageType = targetFormat === "png" ? "image/png" : "image/jpeg";
                const converted = await heic2any({
                    blob: file,
                    toType: imageType,
                    quality: 0.95
                });
                const imageBlob = Array.isArray(converted) ? converted[0] : converted;

                await renderHeicPreview(imageBlob);

                const baseName = getHeicBaseName(file.name);
                if (targetFormat === "pdf") {
                    const image = await blobToImage(imageBlob);
                    const orientation = image.width > image.height ? "landscape" : "portrait";
                    const pdf = new window.jspdf.jsPDF({
                        orientation: orientation,
                        unit: "pt",
                        format: [image.width, image.height]
                    });
                    const canvas = document.createElement("canvas");
                    const ctx = canvas.getContext("2d");
                    canvas.width = image.width;
                    canvas.height = image.height;
                    ctx.drawImage(image, 0, 0);
                    const dataUrl = canvas.toDataURL("image/jpeg", 0.95);
                    pdf.addImage(dataUrl, "JPEG", 0, 0, image.width, image.height);
                    pdf.save(baseName + ".pdf");
                } else {
                    const extension = targetFormat === "png" ? "png" : "jpg";
                    const url = URL.createObjectURL(imageBlob);
                    const a = document.createElement("a");
                    a.href = url;
                    a.download = baseName + "." + extension;
                    a.click();
                    URL.revokeObjectURL(url);
                }

                setHeicStatus("Conversion complete. File downloaded.");
            } catch (error) {
                setHeicStatus("Could not convert this HEIC file: " + error.message, true);
            } finally {
                heicConvertBtn.disabled = false;
                heicConvertBtn.textContent = "Convert HEIC to JPG PNG PDF";
            }
        });
    </script>';
}

function getJpgConverterHTML() {
    return '
    <div class="space-y-6">
        <div style="display:none;">
            <h1>JPG to PNG JPEG PDF Converter Online Free</h1>
            <p>Use this JPG to PNG converter and JPG to PDF converter to convert JPG to PNG free, change JPG to PNG, convert JPG to PDF free, or export JPG files as JPEG directly in your browser.</p>
            <p>Free JPG to PNG converter, JPG to PDF converter free, online JPG to PDF converter, and convert JPG to PNG online free workflows for Windows, Mac, iPhone, and Android browsers.</p>
        </div>
        <div class="rounded-2xl border border-emerald-200/70 bg-emerald-50/80 dark:bg-emerald-950/30 dark:border-emerald-900 p-4">
            <div class="font-semibold text-emerald-900 dark:text-emerald-100">JPG Converter</div>
            <p class="mt-1 text-sm text-emerald-800 dark:text-emerald-200">Upload a JPG or JPEG image, choose PNG, JPEG, or PDF, preview it, and download the converted file in seconds.</p>
        </div>
        <div class="rounded-2xl border border-gray-200 dark:border-gray-700 p-5 space-y-4 bg-white dark:bg-gray-900">
            <input type="file" id="jpgInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".jpg,.jpeg,image/jpeg">
            <select id="jpgOutputFormat" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                <option value="png">Convert to PNG</option>
                <option value="jpeg">Convert to JPEG</option>
                <option value="pdf">Convert to PDF</option>
            </select>
            <div class="rounded-2xl border border-blue-100 bg-blue-50/70 dark:bg-blue-950/20 dark:border-blue-900 p-4 text-sm text-blue-900 dark:text-blue-100">
                How to convert JPG to PNG or PDF:
                Upload the JPG image, choose PNG, JPEG, or PDF, and download the converted file for free.
            </div>
            <button id="jpgConvertBtn" class="w-full bg-emerald-600 text-white py-3 rounded-xl font-semibold hover:bg-emerald-700 transition">Convert JPG to PNG JPEG PDF</button>
            <div id="jpgStatus" class="hidden text-sm text-gray-500 text-center"></div>
        </div>
        <div class="rounded-3xl border border-gray-200 dark:border-gray-700 bg-slate-50 dark:bg-slate-950/40 p-4">
            <div class="text-sm text-gray-500 mb-3">Preview</div>
            <div id="jpgPreviewWrap" class="rounded-2xl border border-dashed border-gray-300 dark:border-gray-700 p-8 text-center text-sm text-gray-500 min-h-[260px] flex items-center justify-center">Converted JPG preview will appear here.</div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        const jpgInput = document.getElementById("jpgInput");
        const jpgOutputFormat = document.getElementById("jpgOutputFormat");
        const jpgConvertBtn = document.getElementById("jpgConvertBtn");
        const jpgStatus = document.getElementById("jpgStatus");
        const jpgPreviewWrap = document.getElementById("jpgPreviewWrap");

        function setJpgStatus(message, isError) {
            if (!message) {
                jpgStatus.textContent = "";
                jpgStatus.classList.add("hidden");
                jpgStatus.classList.remove("text-red-500");
                return;
            }

            jpgStatus.textContent = message;
            jpgStatus.classList.remove("hidden");
            jpgStatus.classList.toggle("text-red-500", !!isError);
        }

        function getJpgBaseName(name) {
            let base = name || "converted";
            base = base.replace(/\\.(jpg|jpeg)$/i, "");
            return base || "converted";
        }

        async function fileToImage(file) {
            return new Promise(function(resolve, reject) {
                const url = URL.createObjectURL(file);
                const image = new Image();
                image.onload = function() {
                    URL.revokeObjectURL(url);
                    resolve(image);
                };
                image.onerror = function() {
                    URL.revokeObjectURL(url);
                    reject(new Error("Could not load the JPG image."));
                };
                image.src = url;
            });
        }

        async function blobToImage(blob) {
            return new Promise(function(resolve, reject) {
                const url = URL.createObjectURL(blob);
                const image = new Image();
                image.onload = function() {
                    URL.revokeObjectURL(url);
                    resolve(image);
                };
                image.onerror = function() {
                    URL.revokeObjectURL(url);
                    reject(new Error("Could not load converted preview."));
                };
                image.src = url;
            });
        }

        function canvasFromImage(image, mimeType, quality) {
            const canvas = document.createElement("canvas");
            const ctx = canvas.getContext("2d");
            canvas.width = image.width;
            canvas.height = image.height;
            ctx.drawImage(image, 0, 0);
            return new Promise(function(resolve) {
                canvas.toBlob(function(blob) {
                    resolve({ blob: blob, canvas: canvas });
                }, mimeType, quality);
            });
        }

        async function renderJpgPreview(blob) {
            const image = await blobToImage(blob);
            jpgPreviewWrap.innerHTML = "";
            image.className = "max-w-full max-h-[520px] mx-auto rounded-xl shadow";
            jpgPreviewWrap.appendChild(image);
        }

        jpgConvertBtn.addEventListener("click", async function() {
            const file = jpgInput.files && jpgInput.files[0] ? jpgInput.files[0] : null;
            if (!file) {
                alert("Please select a JPG file");
                return;
            }

            try {
                jpgConvertBtn.disabled = true;
                jpgConvertBtn.textContent = "Converting...";
                setJpgStatus("Converting JPG file. Please wait...");

                const image = await fileToImage(file);
                const targetFormat = jpgOutputFormat.value;
                const baseName = getJpgBaseName(file.name);

                if (targetFormat === "pdf") {
                    const pdf = new window.jspdf.jsPDF({
                        orientation: image.width > image.height ? "landscape" : "portrait",
                        unit: "pt",
                        format: [image.width, image.height]
                    });
                    const prepared = await canvasFromImage(image, "image/jpeg", 0.95);
                    const dataUrl = prepared.canvas.toDataURL("image/jpeg", 0.95);
                    await renderJpgPreview(prepared.blob);
                    pdf.addImage(dataUrl, "JPEG", 0, 0, image.width, image.height);
                    pdf.save(baseName + ".pdf");
                } else {
                    const mimeType = targetFormat === "png" ? "image/png" : "image/jpeg";
                    const prepared = await canvasFromImage(image, mimeType, 0.95);
                    await renderJpgPreview(prepared.blob);
                    const url = URL.createObjectURL(prepared.blob);
                    const a = document.createElement("a");
                    a.href = url;
                    a.download = baseName + "." + (targetFormat === "png" ? "png" : "jpeg");
                    a.click();
                    URL.revokeObjectURL(url);
                }

                setJpgStatus("Conversion complete. File downloaded.");
            } catch (error) {
                setJpgStatus("Could not convert this JPG file: " + error.message, true);
            } finally {
                jpgConvertBtn.disabled = false;
                jpgConvertBtn.textContent = "Convert JPG to PNG JPEG PDF";
            }
        });
    </script>';
}

function getWebpConverterHTML() {
    return '
    <div class="space-y-6">
        <div style="display:none;">
            <h1>WEBP to JPG PNG JPEG PDF Converter Free Online</h1>
            <p>Use this WEBP to JPG converter to convert WEBP to JPG, WEBP to PNG, WEBP to JPEG, or WEBP to PDF quickly in your browser.</p>
            <p>Convert WEBP to JPG free, use a WEBP to PNG converter free, or convert WEBP to PDF online free without installing software.</p>
            <p>If you need to know how to convert WEBP to JPG, how to convert WEBP to PNG, or how to convert WEBP to PDF, upload your WEBP image, choose the output format, and download instantly.</p>
        </div>
        <div class="rounded-2xl border border-blue-200/70 bg-blue-50/80 dark:bg-blue-950/30 dark:border-blue-900 p-4">
            <div class="font-semibold text-blue-900 dark:text-blue-100">WEBP to JPG PNG PDF Converter</div>
            <p class="mt-1 text-sm text-blue-800 dark:text-blue-200">Convert WEBP to JPG, WEBP to PNG, WEBP to JPEG, or WEBP to PDF online free with fast preview and download.</p>
        </div>
        <div class="rounded-2xl border border-gray-200 dark:border-gray-700 p-5 space-y-4 bg-white dark:bg-gray-900">
            <input type="file" id="webpInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".webp,image/webp">
            <select id="webpOutputFormat" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                <option value="png">Convert to PNG</option>
                <option value="jpg">Convert to JPG</option>
                <option value="jpeg">Convert to JPEG</option>
                <option value="pdf">Convert to PDF</option>
            </select>
            <div class="rounded-2xl border border-blue-100 bg-blue-50/70 dark:bg-blue-950/20 dark:border-blue-900 p-4 text-sm text-blue-900 dark:text-blue-100">
                Convert WEBP to JPG free, change WEBP to PNG, or use this WEBP to PDF converter online when you need a quick WEBP file conversion without losing time.
            </div>
            <button id="webpConvertBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Convert WEBP</button>
            <div id="webpStatus" class="hidden text-sm text-gray-500 text-center"></div>
        </div>
        <div class="rounded-3xl border border-gray-200 dark:border-gray-700 bg-slate-50 dark:bg-slate-950/40 p-4">
            <div class="text-sm text-gray-500 mb-3">Preview</div>
            <div id="webpPreviewWrap" class="rounded-2xl border border-dashed border-gray-300 dark:border-gray-700 p-8 text-center text-sm text-gray-500 min-h-[260px] flex items-center justify-center">Converted WEBP preview will appear here.</div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        const webpInput = document.getElementById("webpInput");
        const webpOutputFormat = document.getElementById("webpOutputFormat");
        const webpConvertBtn = document.getElementById("webpConvertBtn");
        const webpStatus = document.getElementById("webpStatus");
        const webpPreviewWrap = document.getElementById("webpPreviewWrap");

        function setWebpStatus(message, isError) {
            if (!message) {
                webpStatus.textContent = "";
                webpStatus.classList.add("hidden");
                webpStatus.classList.remove("text-red-500");
                return;
            }

            webpStatus.textContent = message;
            webpStatus.classList.remove("hidden");
            webpStatus.classList.toggle("text-red-500", !!isError);
        }

        function getWebpBaseName(name) {
            let base = name || "converted";
            base = base.replace(/\\.webp$/i, "");
            return base || "converted";
        }

        async function fileToWebpImage(file) {
            return new Promise(function(resolve, reject) {
                const url = URL.createObjectURL(file);
                const image = new Image();
                image.onload = function() {
                    URL.revokeObjectURL(url);
                    resolve(image);
                };
                image.onerror = function() {
                    URL.revokeObjectURL(url);
                    reject(new Error("Could not load the WEBP image."));
                };
                image.src = url;
            });
        }

        async function blobToWebpImage(blob) {
            return new Promise(function(resolve, reject) {
                const url = URL.createObjectURL(blob);
                const image = new Image();
                image.onload = function() {
                    URL.revokeObjectURL(url);
                    resolve(image);
                };
                image.onerror = function() {
                    URL.revokeObjectURL(url);
                    reject(new Error("Could not load converted preview."));
                };
                image.src = url;
            });
        }

        function canvasFromWebpImage(image, mimeType, quality) {
            const canvas = document.createElement("canvas");
            const ctx = canvas.getContext("2d");
            canvas.width = image.width;
            canvas.height = image.height;
            ctx.drawImage(image, 0, 0);
            return new Promise(function(resolve) {
                canvas.toBlob(function(blob) {
                    resolve({ blob: blob, canvas: canvas });
                }, mimeType, quality);
            });
        }

        async function renderWebpPreview(blob) {
            const image = await blobToWebpImage(blob);
            webpPreviewWrap.innerHTML = "";
            image.className = "max-w-full max-h-[520px] mx-auto rounded-xl shadow";
            webpPreviewWrap.appendChild(image);
        }

        webpConvertBtn.addEventListener("click", async function() {
            const file = webpInput.files && webpInput.files[0] ? webpInput.files[0] : null;
            if (!file) {
                alert("Please select a WEBP file");
                return;
            }

            try {
                webpConvertBtn.disabled = true;
                webpConvertBtn.textContent = "Converting...";
                setWebpStatus("Converting WEBP file. Please wait...");

                const image = await fileToWebpImage(file);
                const targetFormat = webpOutputFormat.value;
                const baseName = getWebpBaseName(file.name);

                if (targetFormat === "pdf") {
                    const pdf = new window.jspdf.jsPDF({
                        orientation: image.width > image.height ? "landscape" : "portrait",
                        unit: "pt",
                        format: [image.width, image.height]
                    });
                    const prepared = await canvasFromWebpImage(image, "image/jpeg", 0.95);
                    const dataUrl = prepared.canvas.toDataURL("image/jpeg", 0.95);
                    await renderWebpPreview(prepared.blob);
                    pdf.addImage(dataUrl, "JPEG", 0, 0, image.width, image.height);
                    pdf.save(baseName + ".pdf");
                } else {
                    const mimeType = targetFormat === "png" ? "image/png" : "image/jpeg";
                    const prepared = await canvasFromWebpImage(image, mimeType, 0.95);
                    await renderWebpPreview(prepared.blob);
                    const url = URL.createObjectURL(prepared.blob);
                    const a = document.createElement("a");
                    a.href = url;
                    a.download = baseName + "." + (targetFormat === "png" ? "png" : targetFormat);
                    a.click();
                    URL.revokeObjectURL(url);
                }

                setWebpStatus("Conversion complete. File downloaded.");
            } catch (error) {
                setWebpStatus("Could not convert this WEBP file: " + error.message, true);
            } finally {
                webpConvertBtn.disabled = false;
                webpConvertBtn.textContent = "Convert WEBP";
            }
        });
    </script>';
}

function getVideoToAudioHTML() {
    return '
    <div class="space-y-6">
        <div style="display:none;">
            <h1>Video to MP3 Converter Free Online</h1>
            <p>Use this video to MP3 converter to convert video to MP3, turn video to MP3, and extract audio from MP4, MOV, WEBM, AVI, MKV, and more.</p>
            <p>This online video to MP3 converter free tool helps you convert video to MP3 locally in your browser with no upload required.</p>
            <p>Looking for how to convert video to MP3, iPhone video to MP3, TikTok video to MP3, or Instagram video to MP3? Upload your file, choose a format, and download the audio.</p>
        </div>
        <div class="rounded-2xl border border-indigo-200/70 bg-indigo-50/80 dark:bg-indigo-950/30 dark:border-indigo-900 p-4">
            <div class="font-semibold text-indigo-900 dark:text-indigo-100">Video to MP3 Converter</div>
            <p class="mt-1 text-sm text-indigo-800 dark:text-indigo-200">Convert video to MP3, WAV, OGG, AAC, or FLAC directly in your browser. This free video to MP3 converter works with MP4, MOV, WEBM, AVI, MKV, and more.</p>
        </div>
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'videoToAudioInput\').click()">
            <input type="file" id="videoToAudioInput" class="hidden" accept="video/*,.mkv,.avi,.mov,.mp4,.webm,.m4v">
            <div class="text-5xl mb-3">VIDEO</div>
            <p class="font-medium">Upload a video file</p>
            <p class="text-sm text-gray-500 mt-2">Extract MP3 audio locally with FFmpeg WebAssembly</p>
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
            <button id="videoToAudioRunBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Convert Video to Audio</button>
            <button id="videoToAudioDownloadBtn" class="w-full bg-green-600 text-white py-3 rounded-xl font-semibold hover:bg-green-700 transition hidden">Download Audio</button>
        </div>
        <div id="videoToAudioProgressWrap" class="hidden rounded-2xl border border-blue-100 dark:border-blue-900 bg-blue-50/70 dark:bg-blue-950/20 p-4">
            <div class="flex items-center justify-between gap-3 text-sm">
                <span id="videoToAudioProgressLabel" class="font-medium text-blue-900 dark:text-blue-100">Preparing conversion...</span>
                <span id="videoToAudioProgressPercent" class="font-semibold text-blue-700 dark:text-blue-200">0%</span>
            </div>
            <div class="mt-3 h-3 rounded-full bg-blue-100 dark:bg-blue-900/60 overflow-hidden">
                <div id="videoToAudioProgressBar" class="h-full rounded-full bg-blue-600 transition-all duration-300" style="width:0%"></div>
            </div>
        </div>
        <audio id="videoToAudioPlayer" class="w-full hidden" controls></audio>
        <div class="rounded-2xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/60 p-4 text-sm text-gray-600 dark:text-gray-300">Use this free video to MP3 converter online to extract audio from video files quickly. It is useful if you want to turn video to MP3 for podcasts, voice notes, reels, or short clips.</div>
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
              const progressWrap = document.getElementById("videoToAudioProgressWrap");
              const progressLabel = document.getElementById("videoToAudioProgressLabel");
              const progressPercent = document.getElementById("videoToAudioProgressPercent");
              const progressBar = document.getElementById("videoToAudioProgressBar");

              let ffmpeg = null;
              let ffmpegLoaded = false;
              let outputBlob = null;
              let outputName = "";
            let previewUrl = "";
            let audioUrl = "";

              function setStatus(message) {
                  status.textContent = message;
              }

              function setProgress(percent, message) {
                  const safePercent = Math.max(0, Math.min(100, Math.round(percent || 0)));
                  progressWrap.classList.remove("hidden");
                  progressBar.style.width = safePercent + "%";
                  progressPercent.textContent = safePercent + "%";
                  if (message) {
                      progressLabel.textContent = message;
                  }
              }

              function resetProgress() {
                  progressBar.style.width = "0%";
                  progressPercent.textContent = "0%";
                  progressLabel.textContent = "Preparing conversion...";
                  progressWrap.classList.add("hidden");
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
                  ffmpeg.on("progress", function(event) {
                      if (event && typeof event.progress === "number" && isFinite(event.progress)) {
                          setProgress(event.progress * 100, "Extracting audio...");
                      }
                  });

                  const baseURL = "https://cdn.jsdelivr.net/npm/@ffmpeg/core@0.12.6/dist/umd";
                  setStatus("Loading video conversion engine...");
                  setProgress(8, "Loading video conversion engine...");
                  await ffmpeg.load({
                      coreURL: await toBlobURL(baseURL + "/ffmpeg-core.js", "text/javascript"),
                      wasmURL: await toBlobURL(baseURL + "/ffmpeg-core.wasm", "application/wasm")
                  });
                  ffmpegLoaded = true;
                  setStatus("Converter ready.");
                  setProgress(15, "Converter ready.");
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
                  resetProgress();
                  if (!file) return;

                previewUrl = URL.createObjectURL(file);
                preview.src = previewUrl;
                preview.classList.remove("hidden");
                metaWrap.classList.remove("hidden");
                  fileMeta.textContent = file.name + " • " + Math.round(file.size / 1024 / 1024 * 100) / 100 + " MB";
                  setStatus("Video loaded. Choose a format and click Convert to Audio.");
              });

            runBtn.addEventListener("click", async function() {
                const file = input.files[0];
                  if (!file) return alert("Please select a video first");

                  runBtn.disabled = true;
                  runBtn.classList.add("opacity-50", "cursor-not-allowed");
                  runBtn.textContent = "Converting...";
                  downloadBtn.classList.add("hidden");
                  player.classList.add("hidden");
                  player.removeAttribute("src");
                  outputBlob = null;
                  outputName = "";
                  resetProgress();
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
                      setProgress(20, "Preparing video file...");
                      await engine.writeFile(safeInputName, await fetchFile(file));

                      setStatus("Extracting audio...");
                      setProgress(28, "Extracting audio...");
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
                      setProgress(100, "Conversion complete.");

                      try { await engine.deleteFile(safeInputName); } catch (e) {}
                      try { await engine.deleteFile(outputFileName); } catch (e) {}
                  } catch (error) {
                      console.error("Video to audio conversion failed:", error);
                      setStatus("Conversion failed: " + (error && error.message ? error.message : "Unknown error"));
                      setProgress(0, "Conversion failed.");
                  } finally {
                      runBtn.disabled = false;
                      runBtn.classList.remove("opacity-50", "cursor-not-allowed");
                      runBtn.textContent = "Convert Video to Audio";
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
function getVideoCompressorHTML() {
    return '
    <div class="space-y-6">
        <div style="display:none;">
            <h1>Compress Video Online Free</h1>
            <p>Compress video files online free and reduce video file size directly in your browser without uploading to a server.</p>
            <p>Use this video compressor to shrink MP4, MOV, WEBM, AVI, MKV, and other common video files for sharing, storage, or faster uploads.</p>
        </div>
        <div class="rounded-2xl border border-blue-200/70 bg-blue-50/80 dark:bg-blue-950/30 dark:border-blue-900 p-4">
            <div class="font-semibold text-blue-900 dark:text-blue-100">Video Compressor</div>
            <p class="mt-1 text-sm text-blue-800 dark:text-blue-200">Upload a video, choose a compression level, and create a smaller MP4 file directly in your browser.</p>
        </div>
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'videoCompressorInput\').click()">
            <input type="file" id="videoCompressorInput" class="hidden" accept="video/*,.mkv,.avi,.mov,.mp4,.webm,.m4v">
            <div class="text-5xl mb-3">VIDEO</div>
            <p class="font-medium">Upload a video to compress</p>
            <p class="text-sm text-gray-500 mt-2">Compression runs locally with FFmpeg WebAssembly</p>
        </div>
        <div id="videoCompressorMetaWrap" class="hidden rounded-xl border border-gray-200 dark:border-gray-700 bg-white/60 dark:bg-gray-900/30 p-4 space-y-2">
            <div class="font-medium text-sm">Selected file</div>
            <div id="videoCompressorFileMeta" class="text-sm text-gray-500"></div>
            <video id="videoCompressorPreview" class="w-full max-h-72 rounded-xl bg-black hidden" controls preload="metadata"></video>
        </div>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Compression level</label>
                <select id="videoCompressorLevel" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                    <option value="medium" selected>Medium Compression</option>
                    <option value="high">High Compression</option>
                    <option value="low">Low Compression</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Output</label>
                <div class="w-full p-3 bg-gray-50 text-gray-700 dark:bg-gray-900 dark:text-gray-200 rounded-xl border border-gray-200 dark:border-gray-700">Compressed MP4 video</div>
            </div>
        </div>
        <div class="grid sm:grid-cols-2 gap-3">
            <button id="videoCompressorRunBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Compress Video</button>
            <button id="videoCompressorDownloadBtn" class="w-full bg-green-600 text-white py-3 rounded-xl font-semibold hover:bg-green-700 transition hidden">Download Compressed Video</button>
        </div>
        <div id="videoCompressorProgressWrap" class="hidden rounded-2xl border border-blue-100 dark:border-blue-900 bg-blue-50/70 dark:bg-blue-950/20 p-4">
            <div class="flex items-center justify-between gap-3 text-sm">
                <span id="videoCompressorProgressLabel" class="font-medium text-blue-900 dark:text-blue-100">Preparing compression...</span>
                <span id="videoCompressorProgressPercent" class="font-semibold text-blue-700 dark:text-blue-200">0%</span>
            </div>
            <div class="mt-3 h-3 rounded-full bg-blue-100 dark:bg-blue-900/60 overflow-hidden">
                <div id="videoCompressorProgressBar" class="h-full rounded-full bg-blue-600 transition-all duration-300" style="width:0%"></div>
            </div>
        </div>
        <div id="videoCompressorResultWrap" class="hidden rounded-2xl border border-gray-200 dark:border-gray-700 bg-white/70 dark:bg-gray-900/40 p-4 space-y-3">
            <div class="font-medium text-sm">Compressed result</div>
            <div id="videoCompressorResultMeta" class="text-sm text-gray-500"></div>
            <video id="videoCompressorOutputPreview" class="w-full max-h-72 rounded-xl bg-black hidden" controls preload="metadata"></video>
        </div>
        <div class="rounded-2xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/60 p-4 text-sm text-gray-600 dark:text-gray-300">This video compressor reduces file size by re-encoding the uploaded video into a smaller MP4 format in your browser.</div>
        <p id="videoCompressorStatus" class="text-sm text-gray-500 text-center"></p>
    </div>
    <script src="assets/vendor/ffmpeg/ffmpeg.js"></script>
    <script src="assets/vendor/ffmpeg/util.js"></script>
    <script>
        (function() {
            const input = document.getElementById("videoCompressorInput");
            const levelSelect = document.getElementById("videoCompressorLevel");
            const runBtn = document.getElementById("videoCompressorRunBtn");
            const downloadBtn = document.getElementById("videoCompressorDownloadBtn");
            const status = document.getElementById("videoCompressorStatus");
            const metaWrap = document.getElementById("videoCompressorMetaWrap");
            const fileMeta = document.getElementById("videoCompressorFileMeta");
            const preview = document.getElementById("videoCompressorPreview");
            const progressWrap = document.getElementById("videoCompressorProgressWrap");
            const progressLabel = document.getElementById("videoCompressorProgressLabel");
            const progressPercent = document.getElementById("videoCompressorProgressPercent");
            const progressBar = document.getElementById("videoCompressorProgressBar");
            const resultWrap = document.getElementById("videoCompressorResultWrap");
            const resultMeta = document.getElementById("videoCompressorResultMeta");
            const outputPreview = document.getElementById("videoCompressorOutputPreview");

            let ffmpeg = null;
            let ffmpegLoaded = false;
            let outputBlob = null;
            let outputName = "";
            let previewUrl = "";
            let outputUrl = "";

            function setStatus(message) {
                status.textContent = message;
            }

            function setProgress(percent, message) {
                const safePercent = Math.max(0, Math.min(100, Math.round(percent || 0)));
                progressWrap.classList.remove("hidden");
                progressBar.style.width = safePercent + "%";
                progressPercent.textContent = safePercent + "%";
                if (message) progressLabel.textContent = message;
            }

            function resetProgress() {
                progressBar.style.width = "0%";
                progressPercent.textContent = "0%";
                progressLabel.textContent = "Preparing compression...";
                progressWrap.classList.add("hidden");
            }

            function revokeUrls() {
                if (previewUrl) {
                    URL.revokeObjectURL(previewUrl);
                    previewUrl = "";
                }
                if (outputUrl) {
                    URL.revokeObjectURL(outputUrl);
                    outputUrl = "";
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
                ffmpeg.on("progress", function(event) {
                    if (event && typeof event.progress === "number" && isFinite(event.progress)) {
                        setProgress(event.progress * 100, "Compressing video...");
                    }
                });
                const baseURL = "https://cdn.jsdelivr.net/npm/@ffmpeg/core@0.12.6/dist/umd";
                setStatus("Loading video compression engine...");
                setProgress(8, "Loading video compression engine...");
                await ffmpeg.load({
                    coreURL: await toBlobURL(baseURL + "/ffmpeg-core.js", "text/javascript"),
                    wasmURL: await toBlobURL(baseURL + "/ffmpeg-core.wasm", "application/wasm")
                });
                ffmpegLoaded = true;
                setStatus("Compressor ready.");
                setProgress(14, "Compressor ready.");
                return ffmpeg;
            }

            function getCompressionSettings(level) {
                switch (level) {
                    case "high":
                        return { crf: "34", audio: "80k", scale: "960:-2" };
                    case "low":
                        return { crf: "26", audio: "128k", scale: "1280:-2" };
                    case "medium":
                    default:
                        return { crf: "30", audio: "96k", scale: "1280:-2" };
                }
            }

            input.addEventListener("change", function() {
                const file = this.files[0];
                outputBlob = null;
                outputName = "";
                downloadBtn.classList.add("hidden");
                resultWrap.classList.add("hidden");
                outputPreview.classList.add("hidden");
                outputPreview.removeAttribute("src");
                revokeUrls();
                resetProgress();
                if (!file) return;

                previewUrl = URL.createObjectURL(file);
                preview.src = previewUrl;
                preview.classList.remove("hidden");
                metaWrap.classList.remove("hidden");
                fileMeta.textContent = file.name + " • " + Math.round(file.size / 1024 / 1024 * 100) / 100 + " MB";
                setStatus("Video loaded. Choose a compression level and click Compress Video.");
            });

            runBtn.addEventListener("click", async function() {
                const file = input.files[0];
                if (!file) return alert("Please select a video first");

                runBtn.disabled = true;
                runBtn.classList.add("opacity-50", "cursor-not-allowed");
                runBtn.textContent = "Compressing...";
                downloadBtn.classList.add("hidden");
                resultWrap.classList.add("hidden");
                outputPreview.classList.add("hidden");
                outputPreview.removeAttribute("src");
                outputBlob = null;
                outputName = "";
                resetProgress();
                if (outputUrl) {
                    URL.revokeObjectURL(outputUrl);
                    outputUrl = "";
                }

                try {
                    const engine = await ensureFFmpegLoaded();
                    const { fetchFile } = FFmpegUtil;
                    const extMatch = file.name.match(/\.([^.]+)$/);
                    const inputExt = extMatch ? extMatch[1].toLowerCase() : "mp4";
                    const safeInputName = "input." + inputExt;
                    const baseName = file.name.replace(/\.[^.]+$/, "") || "compressed-video";
                    const outputFileName = "compressed.mp4";
                    const settings = getCompressionSettings(levelSelect.value);

                    setStatus("Preparing video file...");
                    setProgress(18, "Preparing video file...");
                    await engine.writeFile(safeInputName, await fetchFile(file));

                    setStatus("Compressing video...");
                    setProgress(24, "Compressing video...");
                    await engine.exec([
                        "-i", safeInputName,
                        "-vf", "scale=\'min(" + settings.scale.split(":")[0] + ",iw)\':-2",
                        "-c:v", "libx264",
                        "-preset", "veryfast",
                        "-crf", settings.crf,
                        "-c:a", "aac",
                        "-b:a", settings.audio,
                        "-movflags", "+faststart",
                        outputFileName
                    ]);

                    const data = await engine.readFile(outputFileName);
                    const bytes = data instanceof Uint8Array ? data : new Uint8Array(data.buffer || data);
                    outputBlob = new Blob([bytes], { type: "video/mp4" });
                    outputName = baseName + "_compressed.mp4";
                    outputUrl = URL.createObjectURL(outputBlob);
                    outputPreview.src = outputUrl;
                    outputPreview.classList.remove("hidden");
                    resultWrap.classList.remove("hidden");
                    downloadBtn.classList.remove("hidden");

                    const originalMb = Math.round(file.size / 1024 / 1024 * 100) / 100;
                    const compressedMb = Math.round(outputBlob.size / 1024 / 1024 * 100) / 100;
                    const saved = file.size > 0 ? Math.max(0, Math.round((1 - (outputBlob.size / file.size)) * 100)) : 0;
                    resultMeta.textContent = "Original: " + originalMb + " MB • Compressed: " + compressedMb + " MB • Saved: " + saved + "%";
                    setStatus("Video compressed successfully.");
                    setProgress(100, "Compression complete.");

                    try { await engine.deleteFile(safeInputName); } catch (e) {}
                    try { await engine.deleteFile(outputFileName); } catch (e) {}
                } catch (error) {
                    console.error("Video compression failed:", error);
                    setStatus("Compression failed: " + (error && error.message ? error.message : "Unknown error"));
                    setProgress(0, "Compression failed.");
                } finally {
                    runBtn.disabled = false;
                    runBtn.classList.remove("opacity-50", "cursor-not-allowed");
                    runBtn.textContent = "Compress Video";
                }
            });

            downloadBtn.addEventListener("click", function() {
                if (!outputBlob) return;
                const url = URL.createObjectURL(outputBlob);
                const a = document.createElement("a");
                a.href = url;
                a.download = outputName || "compressed-video.mp4";
                a.click();
                URL.revokeObjectURL(url);
            });
        })();
    </script>';
}
function getOcrToolHTML() {
    return '
    <div class="space-y-6">
        <div style="display:none;">
            <h1>Online OCR Image to Text Tool</h1>
            <p>Free online OCR for JPG, JPEG, PNG, WEBP, screenshots, receipts, scanned pages, and document photos.</p>
            <p>OCR meaning is optical character recognition. This OCR tool uses Tesseract OCR technology to turn images into editable text in your browser.</p>
        </div>
        <div class="grid 2xl:grid-cols-[1.05fr_0.95fr] gap-6">
            <div class="rounded-[2rem] border border-slate-200/80 dark:border-slate-700/70 bg-gradient-to-br from-white via-blue-50/70 to-cyan-50/70 dark:from-slate-900 dark:via-slate-900 dark:to-slate-950 p-6 shadow-[0_24px_70px_rgba(15,23,42,0.08)]">
                <div class="flex items-start justify-between gap-4 mb-5">
                    <div>
                        <p class="text-[11px] font-black uppercase tracking-[0.22em] text-blue-600 dark:text-blue-400">Free Online OCR</p>
                        <h3 class="text-2xl font-black text-gray-900 dark:text-white mt-2">Extract text from JPG, PNG, and JPEG images</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-3 max-w-2xl">Upload an image and run online OCR directly in your browser. This OCR tool works best for screenshots, scanned pages, receipts, invoices, IDs, and other clear text images.</p>
                    </div>
                    <div class="hidden sm:flex items-center justify-center w-14 h-14 rounded-2xl bg-blue-600/10 text-blue-600 dark:bg-blue-500/15 dark:text-blue-300">
                        <svg width="30" height="30" viewBox="0 0 68 54" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 27s7-10 16-10 16 10 16 10-7 10-16 10S4 27 4 27Z"></path><circle cx="20" cy="27" r="4"></circle><path d="M40 19h20"></path><path d="M40 26h20"></path><path d="M40 33h14"></path></svg>
                    </div>
                </div>

                <label for="ocrImageInput" class="block rounded-[1.8rem] border-2 border-dashed border-slate-300 dark:border-slate-700 bg-white/85 dark:bg-slate-950/60 p-8 text-center cursor-pointer hover:border-blue-500 hover:bg-blue-50/50 dark:hover:bg-slate-900 transition">
                    <input type="file" id="ocrImageInput" class="hidden" accept=".jpg,.jpeg,.png,.webp,.bmp,.gif,image/*">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-600/10 text-blue-600 dark:bg-blue-500/15 dark:text-blue-300">
                        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="2"></rect><circle cx="9" cy="10" r="2"></circle><path d="m21 15-4.5-4.5L7 20"></path></svg>
                    </div>
                    <p class="font-bold text-gray-900 dark:text-white">Choose image for OCR</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Supports JPG, JPEG, PNG, WEBP, BMP, and GIF files. Your file stays on your device.</p>
                </label>

                <div id="ocrPreviewCard" class="hidden mt-5 rounded-[1.6rem] border border-slate-200/80 dark:border-slate-700/80 bg-white/85 dark:bg-slate-950/70 p-4">
                    <div class="flex flex-col md:flex-row gap-4 items-center">
                        <img id="ocrPreviewImg" class="max-w-full md:w-44 h-36 object-contain rounded-2xl bg-slate-50 dark:bg-slate-900 p-2" alt="OCR preview">
                        <div class="text-left flex-1">
                            <p class="text-[11px] font-black uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400">Selected Image</p>
                            <p id="ocrFileMeta" class="mt-2 text-base font-bold text-gray-900 dark:text-white"></p>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">For the best OCR result, use a sharp image with good contrast and straight text.</p>
                        </div>
                    </div>
                </div>

                <div class="mt-5 flex flex-wrap gap-3">
                    <button id="ocrBtn" type="button" class="px-5 py-3 rounded-2xl bg-blue-600 text-white font-bold hover:bg-blue-700 transition">Run OCR</button>
                    <button id="copyOcrBtn" type="button" class="px-5 py-3 rounded-2xl bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-100 font-semibold hover:bg-slate-200 dark:hover:bg-slate-700 transition hidden">Copy Text</button>
                    <button id="downloadOcrBtn" type="button" class="px-5 py-3 rounded-2xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition hidden">Download TXT</button>
                </div>

                <p id="ocrStatus" class="text-sm text-gray-500 dark:text-gray-400 mt-4">OCR meaning is optical character recognition. Click Run OCR to turn image text into editable text.</p>
            </div>

            <div class="rounded-[2rem] border border-slate-200/80 dark:border-slate-700/70 bg-gradient-to-br from-slate-50 via-white to-blue-50/50 dark:from-slate-950 dark:via-slate-950 dark:to-slate-900 p-6">
                <p class="text-[11px] font-black uppercase tracking-[0.22em] text-blue-600 dark:text-blue-400">OCR Result</p>
                <div class="mt-4 rounded-[1.8rem] bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 shadow-sm">
                    <textarea id="ocrText" class="w-full h-72 bg-transparent text-sm leading-7 text-gray-800 dark:text-slate-100 resize-none outline-none" placeholder="Recognized text will appear here after OCR runs."></textarea>
                </div>
                <div class="mt-4 grid sm:grid-cols-2 gap-3">
                    <div class="rounded-[1.4rem] border border-slate-200/80 dark:border-slate-700/80 bg-white/85 dark:bg-slate-950/70 p-4">
                        <p class="text-[11px] font-black uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400">What is OCR?</p>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300 leading-6">What is OCR: OCR technology reads printed text from an image and converts it into selectable, searchable words.</p>
                    </div>
                    <div class="rounded-[1.4rem] border border-slate-200/80 dark:border-slate-700/80 bg-white/85 dark:bg-slate-950/70 p-4">
                        <p class="text-[11px] font-black uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400">Engine</p>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300 leading-6">This free OCR tool uses Tesseract OCR software in the browser, so you can run online OCR without uploading private files.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="rounded-[1.8rem] border border-blue-100 bg-blue-50/70 dark:bg-blue-950/20 dark:border-blue-900 p-5 text-sm text-blue-950 dark:text-blue-100 leading-7">
            If you also need <strong>OCR PDF</strong>, scanned PDF extraction, or PDF to OCR workflows, use the site\'s dedicated OCR PDF tool. This page is focused on image OCR for JPG, PNG, JPEG, screenshots, and document photos.
        </div>
    </div>
    <script src="https://unpkg.com/tesseract.js@4.0.2/dist/tesseract.min.js"></script>
    <script>
        const ocrInput = document.getElementById("ocrImageInput");
        const ocrPreviewCard = document.getElementById("ocrPreviewCard");
        const ocrPreviewImg = document.getElementById("ocrPreviewImg");
        const ocrFileMeta = document.getElementById("ocrFileMeta");
        const ocrBtn = document.getElementById("ocrBtn");
        const ocrStatus = document.getElementById("ocrStatus");
        const ocrText = document.getElementById("ocrText");
        const copyOcrBtn = document.getElementById("copyOcrBtn");
        const downloadOcrBtn = document.getElementById("downloadOcrBtn");

        function setOcrImageStatus(message, isError) {
            ocrStatus.textContent = message || "";
            ocrStatus.classList.toggle("text-red-500", !!isError);
            ocrStatus.classList.toggle("dark:text-red-400", !!isError);
            if (!isError) {
                ocrStatus.classList.remove("text-red-500", "dark:text-red-400");
            }
        }

        function formatBytes(size) {
            const value = Number(size || 0);
            if (!value) return "0 B";
            const units = ["B", "KB", "MB", "GB"];
            let index = 0;
            let current = value;
            while (current >= 1024 && index < units.length - 1) {
                current /= 1024;
                index++;
            }
            return current.toFixed(current >= 10 || index === 0 ? 0 : 1) + " " + units[index];
        }

        function getOcrImageBaseName(name) {
            return String(name || "ocr-image").replace(/\.[^.]+$/, "") || "ocr-image";
        }

        ocrInput.addEventListener("change", function() {
            const file = this.files && this.files[0] ? this.files[0] : null;
            ocrText.value = "";
            copyOcrBtn.classList.add("hidden");
            downloadOcrBtn.classList.add("hidden");

            if (!file) {
                ocrPreviewCard.classList.add("hidden");
                setOcrImageStatus("OCR meaning is optical character recognition. Click Run OCR to turn image text into editable text.");
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                ocrPreviewImg.src = e.target.result;
                ocrPreviewCard.classList.remove("hidden");
            };
            reader.readAsDataURL(file);
            ocrFileMeta.textContent = file.name + " • " + formatBytes(file.size);
            setOcrImageStatus("Image ready. Run online OCR to extract text from the selected file.");
        });

        copyOcrBtn.addEventListener("click", async function() {
            if (!ocrText.value.trim()) return;

            try {
                await navigator.clipboard.writeText(ocrText.value);
                setOcrImageStatus("OCR text copied to clipboard.");
            } catch (error) {
                setOcrImageStatus("Could not copy automatically. Please copy the text manually.", true);
            }
        });

        downloadOcrBtn.addEventListener("click", function() {
            if (!ocrText.value.trim()) return;

            const file = ocrInput.files && ocrInput.files[0] ? ocrInput.files[0] : null;
            const baseName = getOcrImageBaseName(file ? file.name : "");
            const blob = new Blob([ocrText.value], { type: "text/plain;charset=utf-8" });
            const url = URL.createObjectURL(blob);
            const link = document.createElement("a");
            link.href = url;
            link.download = baseName + "_ocr.txt";
            link.click();
            URL.revokeObjectURL(url);
        });

        ocrBtn.addEventListener("click", async function() {
            const file = ocrInput.files && ocrInput.files[0] ? ocrInput.files[0] : null;
            if (!file) {
                alert("Please select a JPG, JPEG, PNG, or image file first.");
                return;
            }

            if (!window.Tesseract) {
                setOcrImageStatus("OCR library failed to load. Please refresh and try again.", true);
                return;
            }

            ocrText.value = "";
            copyOcrBtn.classList.add("hidden");
            downloadOcrBtn.classList.add("hidden");
            setOcrImageStatus("Running Tesseract OCR on your image. This may take a few seconds...");

            try {
                const result = await window.Tesseract.recognize(file, "eng", {
                    logger: function(message) {
                        if (message && message.status) {
                            const progress = typeof message.progress === "number" ? " " + Math.round(message.progress * 100) + "%" : "";
                            setOcrImageStatus("OCR in progress: " + message.status + progress);
                        }
                    }
                });

                const text = result && result.data && result.data.text ? result.data.text.trim() : "";
                ocrText.value = text;
                copyOcrBtn.classList.toggle("hidden", !text);
                downloadOcrBtn.classList.toggle("hidden", !text);

                if (text) {
                    setOcrImageStatus("OCR complete. Text extracted successfully from the image.");
                } else {
                    setOcrImageStatus("OCR finished, but no readable text was detected. Try a sharper or higher-contrast image.", true);
                }
            } catch (error) {
                setOcrImageStatus("Error processing image OCR: " + error.message, true);
            }
        });
    </script>';
}


// ======================== 100% PURE JS FUNCTIONS (FIXED) ========================
function getPdfToWordPureJS() {
    return '
    <div class="space-y-6">
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'pdfToWordInput\').click()">
            <input type="file" id="pdfToWordInput" class="hidden" accept=".pdf">
            <div class="mb-3 flex justify-center text-blue-500"><svg width="76" height="54" viewBox="0 0 76 54" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M8 9h17l6 6v24a3 3 0 0 1-3 3H8a3 3 0 0 1-3-3V12a3 3 0 0 1 3-3Z"></path><path d="M25 9v8h8"></path><path d="M36 27h12"></path><path d="m43 21 6 6-6 6"></path><path d="M55 17h13"></path><path d="M55 24h13"></path><path d="M55 31h9"></path></svg></div>
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
            <div class="mb-3 flex justify-center text-blue-500"><svg width="76" height="54" viewBox="0 0 76 54" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M8 9h17l6 6v24a3 3 0 0 1-3 3H8a3 3 0 0 1-3-3V12a3 3 0 0 1 3-3Z"></path><path d="M25 9v8h8"></path><path d="M36 27h12"></path><path d="m43 21 6 6-6 6"></path><path d="M56 34V22"></path><path d="M62 34V18"></path><path d="M68 34V25"></path></svg></div>
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
            <div class="mb-3 flex justify-center text-blue-500"><svg width="76" height="54" viewBox="0 0 76 54" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M8 9h17l6 6v24a3 3 0 0 1-3 3H8a3 3 0 0 1-3-3V12a3 3 0 0 1 3-3Z"></path><path d="M25 9v8h8"></path><path d="M36 27h12"></path><path d="m43 21 6 6-6 6"></path><path d="M55 33 60 27l4 3 6-9"></path></svg></div>
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
            <div class="mb-3 flex justify-center text-blue-500"><svg width="76" height="54" viewBox="0 0 76 54" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M8 16h13"></path><path d="M8 23h13"></path><path d="M8 30h9"></path><path d="M30 27h12"></path><path d="m37 21 6 6-6 6"></path><path d="M49 9h17l6 6v24a3 3 0 0 1-3 3H49a3 3 0 0 1-3-3V12a3 3 0 0 1 3-3Z"></path><path d="M66 9v8h8"></path></svg></div>
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
        <div style="display:none;">
            <h1>Password Protect PDF Online Free</h1>
            <p>Use this password protect PDF tool to protect PDF files online free, add a password to a PDF file, and secure documents from easy opening or editing.</p>
            <p>Learn how to password protect PDF files, protect PDF from editing, and create a password protected PDF file in your browser without uploading to external software.</p>
        </div>
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" onclick="document.getElementById(\'protectPdfInput\').click()">
            <input type="file" id="protectPdfInput" class="hidden" accept=".pdf">
            <div class="mb-3 flex justify-center text-blue-500"><svg width="54" height="54" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="11" width="14" height="10" rx="2"></rect><path d="M8 11V8a4 4 0 1 1 8 0v3"></path></svg></div>
            <p class="font-medium">Password Protect PDF File</p>
            <p class="text-sm text-gray-500 mt-2">Protect PDF online free with a password and download a secured copy</p>
        </div>
        <div id="protectPreview" class="text-sm text-gray-500 text-center hidden"></div>
        <div class="space-y-4">
            <input type="password" id="pdfPassword" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 border border-gray-200 dark:border-gray-600 rounded-xl" placeholder="Decryption Password">
        </div>
        <div class="rounded-2xl border border-blue-100 bg-blue-50/70 dark:bg-blue-950/20 dark:border-blue-900 p-4 text-sm text-blue-900 dark:text-blue-100">
            How to password protect PDF:
            Upload the PDF, enter a password, protect the PDF file in your browser, and download the secured version.
        </div>
        <button id="protectPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Password Protect PDF Free</button>
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
        <div style="display:none;">
            <h1>Free QR Code Generator Online</h1>
            <p>Use this QR code generator free tool to create static QR codes for URLs, text, WiFi, business cards, and more.</p>
            <p>Best free QR code generator, online QR code generator, free QR code generator no sign up, and QR code generator free online workflow in your browser.</p>
            <p>If you are comparing Adobe QR code generator, Canva QR code generator, Google QR code generator, or the QR code generator tools online, this gives you a privacy-first free option.</p>
        </div>
        <div class="rounded-2xl border border-blue-200/70 bg-blue-50/80 dark:bg-blue-950/30 dark:border-blue-900 p-4">
            <div class="font-semibold text-blue-900 dark:text-blue-100">Free QR Code Generator</div>
            <p class="mt-1 text-sm text-blue-800 dark:text-blue-200">Create a QR code instantly with this free QR code generator online. No sign up, no expiry, and instant PNG download.</p>
        </div>
        <textarea id="qrText" class="w-full h-32 p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 border border-gray-200 dark:border-gray-600 rounded-xl" placeholder="Enter text or URL"></textarea>
        <button id="generateQrBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold transition">Generate Free Code</button>
        <div class="rounded-2xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/60 p-4 text-sm text-gray-600 dark:text-gray-300">This QR code generator free tool works well for website links, menus, contact cards, plain text, and quick sharing. It is a free QR code generator online with no sign up requirement for basic static codes.</div>
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
        <div style="display:none;">
            <h1>HTML to PDF Converter Online Free</h1>
            <p>Convert HTML to PDF online free, change HTML to PDF for invoices and reports, and export `.html` layouts as PDF files in your browser.</p>
        </div>
        <div class="grid 2xl:grid-cols-[1.05fr_0.95fr] gap-6">
            <div class="rounded-[2rem] border border-slate-200/80 dark:border-slate-700/70 bg-gradient-to-br from-white via-blue-50/70 to-cyan-50/70 dark:from-slate-900 dark:via-slate-900 dark:to-slate-950 p-6 shadow-[0_24px_70px_rgba(15,23,42,0.08)]">
                <div class="flex items-start justify-between gap-4 mb-5">
                    <div>
                        <p class="text-[11px] font-black uppercase tracking-[0.22em] text-blue-600 dark:text-blue-400">HTML to PDF</p>
                        <h3 class="text-2xl font-black text-gray-900 dark:text-white mt-2">Convert HTML markup into a polished PDF</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-3 max-w-2xl">Paste HTML for invoices, reports, receipts, letters, or printable layouts and convert it into PDF instantly. Great for HTML to PDF free workflows and browser-based report generation.</p>
                    </div>
                    <div class="hidden sm:flex items-center justify-center w-14 h-14 rounded-2xl bg-blue-600/10 text-blue-600 dark:bg-blue-500/15 dark:text-blue-300 text-xl">&lt;/&gt;</div>
                </div>

                <textarea id="htmlToPdfInput" class="w-full h-72 p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-2xl border border-gray-200 dark:border-gray-600 font-mono text-sm" placeholder="&lt;section style=&quot;font-family: Arial, sans-serif; padding: 24px;&quot;&gt;&lt;h1&gt;Invoice #1001&lt;/h1&gt;&lt;p&gt;Client: Any2Convert&lt;/p&gt;&lt;/section&gt;"></textarea>

                <div class="mt-4 grid sm:grid-cols-2 gap-3">
                    <input id="htmlToPdfFileName" type="text" value="html-to-pdf" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-2xl border border-gray-200 dark:border-gray-600" placeholder="File name">
                    <select id="htmlToPdfFormat" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-2xl border border-gray-200 dark:border-gray-600">
                        <option value="a4" selected>A4 PDF</option>
                        <option value="letter">Letter PDF</option>
                    </select>
                </div>

                <div class="mt-5 flex flex-wrap gap-3">
                    <button id="htmlToPdfPreviewBtn" type="button" class="px-5 py-3 rounded-2xl bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-100 font-semibold hover:bg-slate-200 dark:hover:bg-slate-700 transition">Preview HTML</button>
                    <button id="htmlToPdfBtn" type="button" class="px-5 py-3 rounded-2xl bg-blue-600 text-white font-bold hover:bg-blue-700 transition">Convert HTML to PDF</button>
                </div>

                <p id="htmlToPdfStatus" class="text-sm text-gray-500 dark:text-gray-400 mt-4">Paste HTML and convert it to PDF for invoices, reports, and printable layouts.</p>
            </div>

            <div class="rounded-[2rem] border border-slate-200/80 dark:border-slate-700/70 bg-gradient-to-br from-slate-50 via-white to-blue-50/50 dark:from-slate-950 dark:via-slate-950 dark:to-slate-900 p-6">
                <p class="text-[11px] font-black uppercase tracking-[0.22em] text-blue-600 dark:text-blue-400">Live Preview</p>
                <div id="htmlToPdfPreview" class="mt-4 min-h-[340px] rounded-[1.8rem] border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-5 overflow-auto text-gray-800 dark:text-slate-100 shadow-sm">HTML preview will appear here.</div>
                <div class="mt-4 rounded-[1.4rem] border border-slate-200/80 dark:border-slate-700/80 bg-white/85 dark:bg-slate-950/70 p-4">
                    <p class="text-[11px] font-black uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400">Use cases</p>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-300 leading-6">Invoices, receipts, business reports, proposal pages, printable letters, embedded HTML snippets, and online HTML to PDF converter free workflows.</p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        const htmlInput = document.getElementById("htmlToPdfInput");
        const htmlPreview = document.getElementById("htmlToPdfPreview");
        const htmlStatus = document.getElementById("htmlToPdfStatus");

        function setHtmlToPdfStatus(message, isError) {
            htmlStatus.textContent = message || "";
            htmlStatus.classList.toggle("text-red-500", !!isError);
            htmlStatus.classList.toggle("dark:text-red-400", !!isError);
            if (!isError) {
                htmlStatus.classList.remove("text-red-500", "dark:text-red-400");
            }
        }

        function renderHtmlPreview() {
            const markup = htmlInput.value.trim();
            if (!markup) {
                htmlPreview.textContent = "HTML preview will appear here.";
                setHtmlToPdfStatus("Paste HTML first to preview or convert.", true);
                return null;
            }
            htmlPreview.innerHTML = markup;
            setHtmlToPdfStatus("HTML preview updated.");
            return markup;
        }

        document.getElementById("htmlToPdfPreviewBtn").addEventListener("click", function() {
            renderHtmlPreview();
        });

        document.getElementById("htmlToPdfBtn").addEventListener("click", async function() {
            const markup = renderHtmlPreview();
            if (!markup) return;
            const wrapper = document.createElement("div");
            wrapper.style.padding = "32px";
            wrapper.style.background = "#ffffff";
            wrapper.style.color = "#111827";
            wrapper.style.fontFamily = "Arial, sans-serif";
            wrapper.style.width = "100%";
            wrapper.innerHTML = markup;
            document.body.appendChild(wrapper);
            try {
                const fileName = (document.getElementById("htmlToPdfFileName").value.trim() || "html-to-pdf") + ".pdf";
                const format = document.getElementById("htmlToPdfFormat").value || "a4";
                setHtmlToPdfStatus("Converting HTML to PDF...");
                await html2pdf().set({
                    margin: 0.4,
                    filename: fileName,
                    html2canvas: { scale: 2, useCORS: true },
                    jsPDF: { unit: "in", format: format, orientation: "portrait" }
                }).from(wrapper).save();
                setHtmlToPdfStatus("PDF created successfully.");
            } catch (error) {
                setHtmlToPdfStatus("Error converting HTML to PDF: " + error.message, true);
            } finally {
                wrapper.remove();
            }
        });
    </script>';
}

function getSplitPdfHTML() {
    return '
    <div class="space-y-6" role="main" aria-label="Split PDF Online Free Tool">
        
        <div style="display:none;">
            <h1>Split PDF Online Free - Best Tool to Split PDF Files</h1>
            <p>Learn how to split pdf pages or how to split pdf into multiple files instantly. Our split pdf free online tool is the best alternative to Adobe Acrobat split pdf.</p>
        </div>

        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-blue-500 transition cursor-pointer" 
             onclick="document.getElementById(\'splitPdfInput\').click()"
             title="Click to split pdf online">
            
            <input type="file" id="splitPdfInput" class="hidden" accept=".pdf">
            
            <div class="mb-3 flex justify-center text-blue-500">
                <svg width="54" height="54" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="6" cy="6" r="3"></circle>
                    <circle cx="6" cy="18" r="3"></circle>
                    <path d="M20 4 8.12 15.88"></path>
                    <path d="M14.47 14.48 20 20"></path>
                    <path d="M8.12 8.12 12 12"></path>
                </svg>
            </div>

            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Split PDF Online</h2>
            <p class="font-medium mt-1">Select PDF to split into individual pages</p>
            <p class="text-sm text-gray-500 mt-2">Split pdf pages instantly | 100% Private & Free</p>
        </div>

        <button id="splitPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">
            Split PDF Files (Free Online)
        </button>

        <div id="splitPdfStatus" class="text-sm text-gray-500 text-center hidden"></div>

        <footer class="text-center text-xs text-gray-400 mt-2">
            <p>Fastest way to split pdf document into multiple files.</p>
        </footer>
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
            
            // Optimized Download Name
            a.download = "Any2Convert-split-pdf-pages.zip";
            
            a.click();
            status.textContent = "Done. ZIP downloaded.";
        });
    </script>';
}
function getRemovePagesHTML() {
    return '
    <div class="space-y-6">
        <div style="display:none;">
            <h1>Remove Pages from PDF Free - Remove Pages from PDF Online</h1>
            <p>Use this remove pages from PDF tool to remove pages from PDF online free, learn how to remove pages from PDF files, and clean up your document in seconds.</p>
            <p>Remove pages from PDF free on Windows, Mac, Android, iPhone, and other devices with a simple browser-based workflow.</p>
        </div>
        <div class="rounded-2xl border border-gray-200 dark:border-gray-700 p-5 space-y-4 bg-white dark:bg-gray-900">
            <div>
                <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">Remove PDF Pages</div>
                <p class="text-sm text-gray-500 mt-1">Upload a PDF, preview every page, click pages to mark them with a cross, and remove pages from PDF online free before downloading the cleaned file.</p>
            </div>
            <input type="file" id="removePagesInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
            <div id="removePagesStatus" class="hidden text-sm text-gray-500 text-center"></div>
            <div id="removePagesToolbar" class="hidden flex flex-wrap gap-3">
                <button id="removePagesClearBtn" type="button" class="px-4 py-3 rounded-xl bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-100 font-semibold hover:bg-slate-200 dark:hover:bg-slate-700 transition">Clear Selection</button>
                <button id="removePagesBtn" type="button" class="px-4 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">Remove Selected Pages</button>
            </div>
        </div>
        <div class="rounded-2xl border border-blue-100 bg-blue-50/70 dark:bg-blue-950/20 dark:border-blue-900 p-4 text-sm text-blue-900 dark:text-blue-100">
            How to remove pages from PDF:
            Upload your file, select the pages you want to remove, and download the updated PDF after removing unwanted pages.
        </div>
        <div id="removePagesEmpty" class="rounded-2xl border border-dashed border-gray-300 dark:border-gray-700 p-8 text-center text-sm text-gray-500">PDF pages will appear here after upload so you can remove pages from PDF file visually.</div>
        <div id="removePagesGrid" class="hidden grid sm:grid-cols-2 xl:grid-cols-3 gap-4"></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";

        const removePagesInput = document.getElementById("removePagesInput");
        const removePagesStatus = document.getElementById("removePagesStatus");
        const removePagesToolbar = document.getElementById("removePagesToolbar");
        const removePagesGrid = document.getElementById("removePagesGrid");
        const removePagesEmpty = document.getElementById("removePagesEmpty");
        const removePagesBtn = document.getElementById("removePagesBtn");
        const removePagesClearBtn = document.getElementById("removePagesClearBtn");

        let removePagesPdfBytes = null;
        let removePagesPdfDoc = null;
        let removePagesViewDoc = null;
        let removePagesItems = [];

        function setRemovePagesStatus(message, isError) {
            if (!message) {
                removePagesStatus.textContent = "";
                removePagesStatus.classList.add("hidden");
                removePagesStatus.classList.remove("text-red-500");
                return;
            }

            removePagesStatus.textContent = message;
            removePagesStatus.classList.remove("hidden");
            removePagesStatus.classList.toggle("text-red-500", !!isError);
        }

        function updateRemovePagesVisibility() {
            const hasItems = removePagesItems.length > 0;
            removePagesGrid.classList.toggle("hidden", !hasItems);
            removePagesToolbar.classList.toggle("hidden", !hasItems);
            removePagesEmpty.classList.toggle("hidden", hasItems);
            if (!hasItems) {
                removePagesEmpty.textContent = "PDF pages will appear here after upload.";
            }
        }

        function selectedRemoveCount() {
            return removePagesItems.filter(function(item) { return item.marked; }).length;
        }

        async function renderRemoveThumbnail(pageIndex, canvas) {
            if (!removePagesViewDoc) return;
            const page = await removePagesViewDoc.getPage(pageIndex + 1);
            const viewport = page.getViewport({ scale: 0.32 });
            const context = canvas.getContext("2d");
            canvas.width = Math.ceil(viewport.width);
            canvas.height = Math.ceil(viewport.height);
            context.fillStyle = "#ffffff";
            context.fillRect(0, 0, canvas.width, canvas.height);
            await page.render({ canvasContext: context, viewport: viewport }).promise;
        }

        function createRemovePageCard(item, index) {
            const card = document.createElement("button");
            card.type = "button";
            card.className = "relative rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 shadow-sm overflow-hidden text-left transition";

            const preview = document.createElement("div");
            preview.className = "aspect-[3/4] bg-gray-100 dark:bg-gray-800 flex items-center justify-center overflow-hidden";

            const canvas = document.createElement("canvas");
            canvas.className = "w-full h-full object-contain bg-white";
            preview.appendChild(canvas);
            renderRemoveThumbnail(item.sourceIndex, canvas);

            const mark = document.createElement("div");
            mark.className = "absolute top-3 right-3 w-9 h-9 rounded-full flex items-center justify-center font-black text-lg transition";
            mark.textContent = "×";

            const body = document.createElement("div");
            body.className = "p-4";
            body.innerHTML = "<div class=\"text-xs uppercase tracking-[0.18em] text-gray-400\">Page " + (index + 1) + "</div><div class=\"mt-1 text-sm font-semibold text-gray-900 dark:text-gray-100\">Original PDF page " + (item.sourceIndex + 1) + "</div>";

            card.appendChild(preview);
            card.appendChild(mark);
            card.appendChild(body);

            function syncMarkedState() {
                card.classList.toggle("ring-2", item.marked);
                card.classList.toggle("ring-rose-500", item.marked);
                card.classList.toggle("border-rose-300", item.marked);
                mark.className = item.marked
                    ? "absolute top-3 right-3 w-9 h-9 rounded-full flex items-center justify-center font-black text-lg transition bg-rose-600 text-white shadow-lg"
                    : "absolute top-3 right-3 w-9 h-9 rounded-full flex items-center justify-center font-black text-lg transition bg-white/90 text-slate-400 border border-slate-200";
            }

            card.addEventListener("click", function() {
                item.marked = !item.marked;
                syncMarkedState();
                const count = selectedRemoveCount();
                setRemovePagesStatus(count ? count + " page(s) selected for removal." : "No pages selected for removal.");
            });

            syncMarkedState();
            return card;
        }

        function renderRemovePagesGrid() {
            removePagesGrid.innerHTML = "";
            updateRemovePagesVisibility();
            removePagesItems.forEach(function(item, index) {
                removePagesGrid.appendChild(createRemovePageCard(item, index));
            });
        }

        removePagesInput.addEventListener("change", async function() {
            const file = this.files[0];
            if (!file) return;

            try {
                setRemovePagesStatus("Loading PDF pages...");
                removePagesPdfBytes = await file.arrayBuffer();
                removePagesPdfDoc = await PDFLib.PDFDocument.load(removePagesPdfBytes);
                removePagesViewDoc = await pdfjsLib.getDocument({ data: removePagesPdfBytes }).promise;
                removePagesItems = [];

                for (let i = 0; i < removePagesPdfDoc.getPageCount(); i++) {
                    removePagesItems.push({
                        sourceIndex: i,
                        marked: false
                    });
                }

                renderRemovePagesGrid();
                setRemovePagesStatus("Click any page to mark it with a cross for removal.");
            } catch (error) {
                removePagesItems = [];
                renderRemovePagesGrid();
                setRemovePagesStatus("Could not load this PDF: " + error.message, true);
            }
        });

        removePagesClearBtn.addEventListener("click", function() {
            removePagesItems.forEach(function(item) {
                item.marked = false;
            });
            renderRemovePagesGrid();
            setRemovePagesStatus("Selection cleared.");
        });

        removePagesBtn.addEventListener("click", async function() {
            const selectedIndexes = removePagesItems
                .map(function(item, index) { return item.marked ? index : -1; })
                .filter(function(index) { return index >= 0; })
                .sort(function(a, b) { return b - a; });

            if (!removePagesPdfDoc || !removePagesItems.length) return alert("Please select a PDF file");
            if (!selectedIndexes.length) return alert("Please select at least one page to remove.");
            if (selectedIndexes.length === removePagesItems.length) return alert("At least one page must remain in the PDF.");

            try {
                setRemovePagesStatus("Removing selected pages...");
                const pdf = await PDFLib.PDFDocument.load(removePagesPdfBytes);
                selectedIndexes.forEach(function(index) {
                    if (index < pdf.getPageCount()) {
                        pdf.removePage(index);
                    }
                });

                const bytes = await pdf.save();
                const file = removePagesInput.files[0];
                const baseName = file && file.name ? file.name.replace(/\.pdf$/i, "") : "pages-removed";
                const a = document.createElement("a");
                a.href = URL.createObjectURL(new Blob([bytes], { type: "application/pdf" }));
                a.download = baseName + "-pages-removed.pdf";
                a.click();
                setRemovePagesStatus(selectedIndexes.length + " page(s) removed. Your new PDF has been downloaded.");
            } catch (error) {
                setRemovePagesStatus("Could not remove pages: " + error.message, true);
            }
        });
    </script>';
}

function getExtractPagesHTML() {
    return '
    <div class="space-y-6">
        <div style="display:none;">
            <h1>Extract Pages from PDF Free - Extract Pages from PDF Online</h1>
            <p>Use this tool to extract pages from PDF online free, learn how to extract pages from PDF documents, and download only the pages you need.</p>
            <p>Extract pages from PDF free on Mac, Windows, Linux, and mobile devices with a simple visual page selector.</p>
            <p>Use it as a split PDF tool to split PDF pages, split PDF into individual pages, split PDF into multiple files, and manage split PDF files online free.</p>
        </div>
        <div class="rounded-2xl border border-gray-200 dark:border-gray-700 p-5 space-y-4 bg-white dark:bg-gray-900">
            <div>
                <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">Extract Pages from PDF</div>
                <p class="text-sm text-gray-500 mt-1">Upload a PDF, click the pages you want to keep, and download a new PDF containing only those selected pages. This also works well if you want to split PDF pages or split PDF into pages.</p>
            </div>
            <input type="file" id="extractPagesInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
            <div id="extractPagesStatus" class="hidden text-sm text-gray-500 text-center"></div>
            <div id="extractPagesToolbar" class="hidden flex flex-wrap gap-3">
                <button id="extractPagesClearBtn" type="button" class="px-4 py-3 rounded-xl bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-100 font-semibold hover:bg-slate-200 dark:hover:bg-slate-700 transition">Clear Selection</button>
                <button id="extractPagesBtn" type="button" class="px-4 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">Extract Selected Pages</button>
            </div>
        </div>
        <div class="rounded-2xl border border-blue-100 bg-blue-50/70 dark:bg-blue-950/20 dark:border-blue-900 p-4 text-sm text-blue-900 dark:text-blue-100">
            How to extract pages from PDF:
            Upload your file, click the pages you want to extract, and download a smaller PDF with only the selected pages. You can also use this workflow to split PDF online free and create a split PDF file from selected pages.
        </div>
        <div id="extractPagesEmpty" class="rounded-2xl border border-dashed border-gray-300 dark:border-gray-700 p-8 text-center text-sm text-gray-500">PDF pages will appear here after upload so you can extract pages from PDF file visually or use it as a split PDF online tool.</div>
        <div id="extractPagesGrid" class="hidden grid sm:grid-cols-2 xl:grid-cols-3 gap-4"></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";

        const extractPagesInput = document.getElementById("extractPagesInput");
        const extractPagesStatus = document.getElementById("extractPagesStatus");
        const extractPagesToolbar = document.getElementById("extractPagesToolbar");
        const extractPagesGrid = document.getElementById("extractPagesGrid");
        const extractPagesEmpty = document.getElementById("extractPagesEmpty");
        const extractPagesBtn = document.getElementById("extractPagesBtn");
        const extractPagesClearBtn = document.getElementById("extractPagesClearBtn");

        let extractPagesPdfBytes = null;
        let extractPagesPdfDoc = null;
        let extractPagesViewDoc = null;
        let extractPagesItems = [];

        function setExtractPagesStatus(message, isError) {
            if (!message) {
                extractPagesStatus.textContent = "";
                extractPagesStatus.classList.add("hidden");
                extractPagesStatus.classList.remove("text-red-500");
                return;
            }

            extractPagesStatus.textContent = message;
            extractPagesStatus.classList.remove("hidden");
            extractPagesStatus.classList.toggle("text-red-500", !!isError);
        }

        function updateExtractPagesVisibility() {
            const hasItems = extractPagesItems.length > 0;
            extractPagesGrid.classList.toggle("hidden", !hasItems);
            extractPagesToolbar.classList.toggle("hidden", !hasItems);
            extractPagesEmpty.classList.toggle("hidden", hasItems);
            if (!hasItems) {
                extractPagesEmpty.textContent = "PDF pages will appear here after upload.";
            }
        }

        function selectedExtractCount() {
            return extractPagesItems.filter(function(item) { return item.selected; }).length;
        }

        async function renderExtractThumbnail(pageIndex, canvas) {
            if (!extractPagesViewDoc) return;
            const page = await extractPagesViewDoc.getPage(pageIndex + 1);
            const viewport = page.getViewport({ scale: 0.32 });
            const context = canvas.getContext("2d");
            canvas.width = Math.ceil(viewport.width);
            canvas.height = Math.ceil(viewport.height);
            context.fillStyle = "#ffffff";
            context.fillRect(0, 0, canvas.width, canvas.height);
            await page.render({ canvasContext: context, viewport: viewport }).promise;
        }

        function createExtractPageCard(item, index) {
            const card = document.createElement("button");
            card.type = "button";
            card.className = "relative rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 shadow-sm overflow-hidden text-left transition";

            const preview = document.createElement("div");
            preview.className = "aspect-[3/4] bg-gray-100 dark:bg-gray-800 flex items-center justify-center overflow-hidden";

            const canvas = document.createElement("canvas");
            canvas.className = "w-full h-full object-contain bg-white";
            preview.appendChild(canvas);
            renderExtractThumbnail(item.sourceIndex, canvas);

            const mark = document.createElement("div");
            mark.className = "absolute top-3 right-3 min-w-[38px] h-9 px-2 rounded-full flex items-center justify-center font-black text-xs transition";
            mark.textContent = "Keep";

            const body = document.createElement("div");
            body.className = "p-4";
            body.innerHTML = "<div class=\"text-xs uppercase tracking-[0.18em] text-gray-400\">Page " + (index + 1) + "</div><div class=\"mt-1 text-sm font-semibold text-gray-900 dark:text-gray-100\">Original PDF page " + (item.sourceIndex + 1) + "</div>";

            card.appendChild(preview);
            card.appendChild(mark);
            card.appendChild(body);

            function syncSelectedState() {
                card.classList.toggle("ring-2", item.selected);
                card.classList.toggle("ring-emerald-500", item.selected);
                card.classList.toggle("border-emerald-300", item.selected);
                mark.className = item.selected
                    ? "absolute top-3 right-3 min-w-[38px] h-9 px-2 rounded-full flex items-center justify-center font-black text-xs transition bg-emerald-600 text-white shadow-lg"
                    : "absolute top-3 right-3 min-w-[38px] h-9 px-2 rounded-full flex items-center justify-center font-black text-xs transition bg-white/90 text-slate-400 border border-slate-200";
                mark.textContent = item.selected ? "Keep" : "Select";
            }

            card.addEventListener("click", function() {
                item.selected = !item.selected;
                syncSelectedState();
                const count = selectedExtractCount();
                setExtractPagesStatus(count ? count + " page(s) selected for extraction." : "No pages selected.");
            });

            syncSelectedState();
            return card;
        }

        function renderExtractPagesGrid() {
            extractPagesGrid.innerHTML = "";
            updateExtractPagesVisibility();
            extractPagesItems.forEach(function(item, index) {
                extractPagesGrid.appendChild(createExtractPageCard(item, index));
            });
        }

        extractPagesInput.addEventListener("change", async function() {
            const file = this.files[0];
            if (!file) return;

            try {
                setExtractPagesStatus("Loading PDF pages...");
                extractPagesPdfBytes = await file.arrayBuffer();
                extractPagesPdfDoc = await PDFLib.PDFDocument.load(extractPagesPdfBytes);
                extractPagesViewDoc = await pdfjsLib.getDocument({ data: extractPagesPdfBytes }).promise;
                extractPagesItems = [];

                for (let i = 0; i < extractPagesPdfDoc.getPageCount(); i++) {
                    extractPagesItems.push({
                        sourceIndex: i,
                        selected: false
                    });
                }

                renderExtractPagesGrid();
                setExtractPagesStatus("Click pages to choose which ones to extract.");
            } catch (error) {
                extractPagesItems = [];
                renderExtractPagesGrid();
                setExtractPagesStatus("Could not load this PDF: " + error.message, true);
            }
        });

        extractPagesClearBtn.addEventListener("click", function() {
            extractPagesItems.forEach(function(item) {
                item.selected = false;
            });
            renderExtractPagesGrid();
            setExtractPagesStatus("Selection cleared.");
        });

        extractPagesBtn.addEventListener("click", async function() {
            const selectedIndexes = extractPagesItems
                .map(function(item) { return item.selected ? item.sourceIndex : -1; })
                .filter(function(index) { return index >= 0; });

            if (!extractPagesPdfDoc || !extractPagesItems.length) return alert("Please select a PDF file");
            if (!selectedIndexes.length) return alert("Please select at least one page to extract.");

            try {
                setExtractPagesStatus("Extracting selected pages...");
                const src = await PDFLib.PDFDocument.load(extractPagesPdfBytes);
                const out = await PDFLib.PDFDocument.create();
                const pages = await out.copyPages(src, selectedIndexes);
                pages.forEach(function(page) {
                    out.addPage(page);
                });

                const bytes = await out.save();
                const file = extractPagesInput.files[0];
                const baseName = file && file.name ? file.name.replace(/\.pdf$/i, "") : "extracted-pages";
                const a = document.createElement("a");
                a.href = URL.createObjectURL(new Blob([bytes], { type: "application/pdf" }));
                a.download = baseName + "-extracted-pages.pdf";
                a.click();
                setExtractPagesStatus(selectedIndexes.length + " page(s) extracted. Your new PDF has been downloaded.");
            } catch (error) {
                setExtractPagesStatus("Could not extract pages: " + error.message, true);
            }
        });
    </script>';
}

function getOrganizePdfHTML() {
    return '
    <div class="space-y-6">
        <div style="display:none;">
            <h1>Organize PDF Online Free - Organize PDF Pages</h1>
            <p>Use this organize PDF tool to organize PDF pages, reorder documents, and learn how to organize PDF pages online free in a visual editor.</p>
            <p>Organize PDF files free, organize PDF files online free, and manage page order, deletion, and blank page insertion in one place.</p>
        </div>
        <div class="rounded-2xl border border-gray-200 dark:border-gray-700 p-5 space-y-4 bg-white dark:bg-gray-900">
            <div>
                <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">Organize PDF Pages</div>
                <p class="text-sm text-gray-500 mt-1">Upload a PDF to organize PDF pages online, drag and drop to reorder pages, delete pages, insert blank pages, and save the updated file.</p>
            </div>
            <input type="file" id="organizePdfInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
            <div id="organizePdfStatus" class="hidden text-sm text-gray-500 text-center"></div>
            <div id="organizePdfToolbar" class="hidden flex flex-wrap gap-3">
                <button id="organizeAddBlankBtn" type="button" class="px-4 py-3 rounded-xl bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-100 font-semibold hover:bg-slate-200 dark:hover:bg-slate-700 transition">Add Blank Page</button>
                <button id="organizeResetBtn" type="button" class="px-4 py-3 rounded-xl bg-amber-100 text-amber-900 dark:bg-amber-900/30 dark:text-amber-200 font-semibold hover:bg-amber-200 dark:hover:bg-amber-900/50 transition">Reset Order</button>
                <button id="organizePdfBtn" type="button" class="px-4 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">Save Organized PDF</button>
            </div>
        </div>
        <div class="rounded-2xl border border-blue-100 bg-blue-50/70 dark:bg-blue-950/20 dark:border-blue-900 p-4 text-sm text-blue-900 dark:text-blue-100">
            How to organize PDF pages:
            Upload your file, preview every page, drag and drop to reorder, remove pages you do not need, and save your organize PDF file online free.
        </div>
        <div id="organizePdfEmpty" class="rounded-2xl border border-dashed border-gray-300 dark:border-gray-700 p-8 text-center text-sm text-gray-500">PDF page thumbnails will appear here after upload so you can organize PDF files free.</div>
        <div id="organizePdfGrid" class="hidden grid sm:grid-cols-2 xl:grid-cols-3 gap-4"></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";

        const organizeInput = document.getElementById("organizePdfInput");
        const organizeGrid = document.getElementById("organizePdfGrid");
        const organizeEmpty = document.getElementById("organizePdfEmpty");
        const organizeStatus = document.getElementById("organizePdfStatus");
        const organizeToolbar = document.getElementById("organizePdfToolbar");
        const organizeSaveBtn = document.getElementById("organizePdfBtn");
        const organizeResetBtn = document.getElementById("organizeResetBtn");
        const organizeAddBlankBtn = document.getElementById("organizeAddBlankBtn");

        let organizeSourceBytes = null;
        let organizeSourcePdf = null;
        let organizeViewPdf = null;
        let organizePages = [];
        let organizeOriginalPages = [];
        let draggedPageId = null;
        let organizeIdCounter = 0;

        function nextOrganizeId() {
            organizeIdCounter += 1;
            return "page_" + organizeIdCounter;
        }

        function setOrganizeStatus(message, isError) {
            if (!message) {
                organizeStatus.textContent = "";
                organizeStatus.classList.add("hidden");
                organizeStatus.classList.remove("text-red-500");
                return;
            }

            organizeStatus.textContent = message;
            organizeStatus.classList.remove("hidden");
            organizeStatus.classList.toggle("text-red-500", !!isError);
        }

        function clonePageState(page) {
            return {
                id: page.id,
                type: page.type,
                sourceIndex: page.sourceIndex,
                width: page.width,
                height: page.height
            };
        }

        function updateOrganizerVisibility() {
            const hasPages = organizePages.length > 0;
            organizeGrid.classList.toggle("hidden", !hasPages);
            organizeToolbar.classList.toggle("hidden", !hasPages);
            organizeEmpty.classList.toggle("hidden", hasPages);
            if (!hasPages) {
                organizeEmpty.textContent = "PDF page thumbnails will appear here after upload.";
            }
        }

        function createPageCard(page, index) {
            const card = document.createElement("div");
            card.className = "rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 shadow-sm overflow-hidden";
            card.draggable = true;
            card.dataset.pageId = page.id;

            const preview = document.createElement("div");
            preview.className = "aspect-[3/4] bg-gray-100 dark:bg-gray-800 flex items-center justify-center overflow-hidden";

            if (page.type === "source") {
                const canvas = document.createElement("canvas");
                canvas.className = "w-full h-full object-contain bg-white";
                preview.appendChild(canvas);
                renderOrganizeThumbnail(page.sourceIndex, canvas);
            } else {
                preview.innerHTML = "<div class=\"text-center px-4\"><div class=\"text-4xl font-black text-slate-300 dark:text-slate-600\">+</div><div class=\"mt-2 text-sm font-semibold text-slate-500 dark:text-slate-300\">Blank Page</div></div>";
            }

            const body = document.createElement("div");
            body.className = "p-4 space-y-3";

            const top = document.createElement("div");
            top.className = "flex items-center justify-between gap-3";
            top.innerHTML = "<div><div class=\"text-xs uppercase tracking-[0.18em] text-gray-400\">Page " + (index + 1) + "</div><div class=\"text-sm font-semibold text-gray-900 dark:text-gray-100\">" + (page.type === "source" ? "Original PDF page " + (page.sourceIndex + 1) : "Inserted blank page") + "</div></div>";

            const actions = document.createElement("div");
            actions.className = "flex flex-wrap gap-2";

            const insertBtn = document.createElement("button");
            insertBtn.type = "button";
            insertBtn.className = "px-3 py-2 rounded-lg bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-100 text-xs font-semibold";
            insertBtn.textContent = "Insert Blank After";
            insertBtn.addEventListener("click", function() {
                insertBlankPage(index + 1, page.width, page.height);
            });

            const deleteBtn = document.createElement("button");
            deleteBtn.type = "button";
            deleteBtn.className = "px-3 py-2 rounded-lg bg-rose-100 text-rose-800 dark:bg-rose-900/30 dark:text-rose-200 text-xs font-semibold";
            deleteBtn.textContent = "Delete";
            deleteBtn.addEventListener("click", function() {
                deletePage(page.id);
            });

            actions.appendChild(insertBtn);
            actions.appendChild(deleteBtn);

            body.appendChild(top);
            body.appendChild(actions);
            card.appendChild(preview);
            card.appendChild(body);

            card.addEventListener("dragstart", function() {
                draggedPageId = page.id;
                card.classList.add("opacity-60");
            });

            card.addEventListener("dragend", function() {
                draggedPageId = null;
                card.classList.remove("opacity-60");
            });

            card.addEventListener("dragover", function(event) {
                event.preventDefault();
                card.classList.add("ring-2", "ring-blue-500");
            });

            card.addEventListener("dragleave", function() {
                card.classList.remove("ring-2", "ring-blue-500");
            });

            card.addEventListener("drop", function(event) {
                event.preventDefault();
                card.classList.remove("ring-2", "ring-blue-500");
                movePage(draggedPageId, page.id);
            });

            return card;
        }

        async function renderOrganizeThumbnail(sourceIndex, canvas) {
            if (!organizeViewPdf) return;
            const pdfPage = await organizeViewPdf.getPage(sourceIndex + 1);
            const viewport = pdfPage.getViewport({ scale: 0.32 });
            const context = canvas.getContext("2d");
            canvas.width = Math.ceil(viewport.width);
            canvas.height = Math.ceil(viewport.height);
            context.fillStyle = "#ffffff";
            context.fillRect(0, 0, canvas.width, canvas.height);
            await pdfPage.render({ canvasContext: context, viewport: viewport }).promise;
        }

        function renderOrganizeGrid() {
            organizeGrid.innerHTML = "";
            updateOrganizerVisibility();
            organizePages.forEach(function(page, index) {
                organizeGrid.appendChild(createPageCard(page, index));
            });
        }

        function insertBlankPage(index, width, height) {
            const reference = organizePages[Math.max(0, Math.min(index - 1, organizePages.length - 1))];
            organizePages.splice(index, 0, {
                id: nextOrganizeId(),
                type: "blank",
                sourceIndex: null,
                width: width || (reference ? reference.width : 595),
                height: height || (reference ? reference.height : 842)
            });
            renderOrganizeGrid();
        }

        function deletePage(pageId) {
            organizePages = organizePages.filter(function(page) {
                return page.id !== pageId;
            });
            renderOrganizeGrid();
        }

        function movePage(dragId, targetId) {
            if (!dragId || !targetId || dragId === targetId) return;
            const fromIndex = organizePages.findIndex(function(page) { return page.id === dragId; });
            const toIndex = organizePages.findIndex(function(page) { return page.id === targetId; });
            if (fromIndex === -1 || toIndex === -1) return;

            const moved = organizePages.splice(fromIndex, 1)[0];
            organizePages.splice(toIndex, 0, moved);
            renderOrganizeGrid();
        }

        organizeInput.addEventListener("change", async function() {
            const file = this.files[0];
            if (!file) return;

            try {
                setOrganizeStatus("Loading PDF pages...");
                organizeSourceBytes = await file.arrayBuffer();
                organizeSourcePdf = await PDFLib.PDFDocument.load(organizeSourceBytes);
                organizeViewPdf = await pdfjsLib.getDocument({ data: organizeSourceBytes }).promise;
                organizePages = [];

                for (let i = 0; i < organizeSourcePdf.getPageCount(); i++) {
                    const page = organizeSourcePdf.getPage(i);
                    organizePages.push({
                        id: nextOrganizeId(),
                        type: "source",
                        sourceIndex: i,
                        width: page.getWidth(),
                        height: page.getHeight()
                    });
                }

                organizeOriginalPages = organizePages.map(clonePageState);
                renderOrganizeGrid();
                setOrganizeStatus("Drag pages to reorder. You can also delete pages or insert blank pages.");
            } catch (error) {
                organizePages = [];
                organizeOriginalPages = [];
                renderOrganizeGrid();
                setOrganizeStatus("Could not load this PDF: " + error.message, true);
            }
        });

        organizeAddBlankBtn.addEventListener("click", function() {
            insertBlankPage(organizePages.length, organizePages[organizePages.length - 1] ? organizePages[organizePages.length - 1].width : 595, organizePages[organizePages.length - 1] ? organizePages[organizePages.length - 1].height : 842);
        });

        organizeResetBtn.addEventListener("click", function() {
            if (!organizeOriginalPages.length) return;
            organizePages = organizeOriginalPages.map(clonePageState);
            renderOrganizeGrid();
            setOrganizeStatus("Page order reset to the original PDF.");
        });

        organizeSaveBtn.addEventListener("click", async function() {
            if (!organizeSourcePdf || !organizePages.length) return alert("Please upload a PDF first.");

            try {
                setOrganizeStatus("Saving organized PDF...");
                const out = await PDFLib.PDFDocument.create();
                const sourceIndexes = organizePages
                    .filter(function(page) { return page.type === "source"; })
                    .map(function(page) { return page.sourceIndex; });

                const copiedPages = sourceIndexes.length
                    ? await out.copyPages(organizeSourcePdf, sourceIndexes)
                    : [];
                let copiedPointer = 0;

                organizePages.forEach(function(page) {
                    if (page.type === "source") {
                        out.addPage(copiedPages[copiedPointer]);
                        copiedPointer += 1;
                    } else {
                        out.addPage([page.width || 595, page.height || 842]);
                    }
                });

                const bytes = await out.save();
                const file = organizeInput.files[0];
                const baseName = file && file.name ? file.name.replace(/\.pdf$/i, "") : "organized";
                const a = document.createElement("a");
                a.href = URL.createObjectURL(new Blob([bytes], { type: "application/pdf" }));
                a.download = baseName + "-organized.pdf";
                a.click();
                setOrganizeStatus("Organized PDF ready. Your updated file has been downloaded.");
            } catch (error) {
                setOrganizeStatus("Could not save this PDF: " + error.message, true);
            }
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
        <div style="display:none;">
            <h1>Repair PDF Online Free - Repair PDF File</h1>
            <p>Use this repair PDF tool to repair PDF files online free, rebuild damaged PDF documents, and learn how to repair PDF file issues directly in your browser.</p>
            <p>Repair PDF file online free, repair PDF files with browser-based rebuilding, and create a cleaner copy when a document has minor structure or compatibility issues.</p>
        </div>
        <div class="rounded-2xl border border-gray-200 dark:border-gray-700 p-5 space-y-4 bg-white dark:bg-gray-900">
            <div>
                <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">Repair PDF File</div>
                <p class="text-sm text-gray-500 mt-1">Upload a PDF to repair PDF file issues, rebuild the document structure, and download a fresh repaired copy.</p>
            </div>
            <input type="file" id="repairPdfInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
            <div id="repairPdfStatus" class="hidden text-sm text-gray-500 text-center"></div>
            <div class="rounded-2xl border border-blue-100 bg-blue-50/70 dark:bg-blue-950/20 dark:border-blue-900 p-4 text-sm text-blue-900 dark:text-blue-100">
                How to repair PDF:
                Upload the file, let the tool rebuild the PDF, and download a repaired version if the browser can recover the document pages.
            </div>
            <button id="repairPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Repair PDF</button>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";
        document.getElementById("repairPdfBtn").addEventListener("click", async function() {
            const file = document.getElementById("repairPdfInput").files[0];
            if (!file) return alert("Please select a PDF file");
            const status = document.getElementById("repairPdfStatus");
            status.classList.remove("hidden", "text-red-500");
            try {
                status.textContent = "Trying direct PDF repair...";
                const sourceBytes = await file.arrayBuffer();

                try {
                    const pdf = await PDFLib.PDFDocument.load(sourceBytes, { ignoreEncryption: true });
                    const bytes = await pdf.save({ useObjectStreams: false, addDefaultPage: false });
                    const a = document.createElement("a");
                    a.href = URL.createObjectURL(new Blob([bytes], { type: "application/pdf" }));
                    a.download = (file.name.replace(/\.pdf$/i, "") || "repaired") + "-repaired.pdf";
                    a.click();
                    status.textContent = "Repair complete. Rebuilt PDF downloaded.";
                    return;
                } catch (directError) {
                    status.textContent = "Direct repair failed. Rebuilding pages visually...";
                }

                const pdfView = await pdfjsLib.getDocument({ data: sourceBytes }).promise;
                const { jsPDF } = window.jspdf;
                let doc = null;

                for (let i = 1; i <= pdfView.numPages; i++) {
                    status.textContent = "Rebuilding page " + i + " of " + pdfView.numPages + "...";
                    const page = await pdfView.getPage(i);
                    const viewport = page.getViewport({ scale: 1.6 });
                    const canvas = document.createElement("canvas");
                    const context = canvas.getContext("2d", { alpha: false });
                    canvas.width = Math.ceil(viewport.width);
                    canvas.height = Math.ceil(viewport.height);
                    context.fillStyle = "#FFFFFF";
                    context.fillRect(0, 0, canvas.width, canvas.height);

                    await page.render({
                        canvasContext: context,
                        viewport: viewport
                    }).promise;

                    const orientation = viewport.width > viewport.height ? "landscape" : "portrait";
                    const pageFormat = [Math.ceil(viewport.width), Math.ceil(viewport.height)];

                    if (!doc) {
                        doc = new jsPDF({
                            orientation: orientation,
                            unit: "pt",
                            format: pageFormat,
                            compress: true
                        });
                    } else {
                        doc.addPage(pageFormat, orientation);
                    }

                    const imageData = canvas.toDataURL("image/jpeg", 0.92);
                    doc.addImage(imageData, "JPEG", 0, 0, pageFormat[0], pageFormat[1], undefined, "FAST");
                }

                if (!doc) {
                    throw new Error("No pages could be rebuilt.");
                }

                const repairedBytes = doc.output("arraybuffer");
                const a = document.createElement("a");
                a.href = URL.createObjectURL(new Blob([repairedBytes], { type: "application/pdf" }));
                a.download = (file.name.replace(/\.pdf$/i, "") || "repaired") + "-repaired.pdf";
                a.click();
                status.textContent = "Repair complete. Visual rebuilt PDF downloaded.";
            } catch (e) {
                status.classList.add("text-red-500");
                status.textContent = "This PDF could not be repaired in the browser: " + e.message;
            }
        });
    </script>';
}

function getOcrPdfHTML() {
    return '
    <div class="space-y-6">
        <div style="display:none;">
            <h1>OCR PDF Online Free - Extract Text From Scanned PDF</h1>
            <p>Use this OCR PDF tool to recognize text from scanned documents, make PDF text selectable, and run free OCR PDF conversion online in your browser.</p>
            <p>Free OCR PDF to text, OCR PDF to Word style content, OCR PDF converter, and online OCR PDF processing for searchable scanned files on Windows, Mac, and mobile.</p>
        </div>
        <div class="rounded-2xl border border-gray-200 dark:border-gray-700 p-5 space-y-4 bg-white dark:bg-gray-900">
            <div>
                <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">OCR PDF Converter</div>
                <p class="text-sm text-gray-500 mt-1">Upload a scanned or image-based PDF to extract text with OCR, make the content searchable, and copy or download the recognized text for free.</p>
            </div>
            <input type="file" id="ocrPdfInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
            <div id="ocrPdfPreview" class="hidden text-sm text-gray-500 text-center"></div>
            <button id="ocrPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">OCR PDF Free</button>
            <div id="ocrPdfStatus" class="text-sm text-gray-500 text-center hidden"></div>
        </div>
        <div class="rounded-2xl border border-blue-100 bg-blue-50/70 dark:bg-blue-950/20 dark:border-blue-900 p-4 text-sm text-blue-900 dark:text-blue-100">
            What is OCR PDF:
            OCR reads scanned PDF pages like images and converts them into selectable text. This helps when you need OCR PDF to text, OCR PDF to Word-style content, or searchable document text.
        </div>
        <textarea id="ocrPdfOutput" class="hidden w-full h-64 p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Recognized text will appear here..."></textarea>
        <div id="ocrPdfActions" class="hidden flex flex-wrap gap-3">
            <button id="ocrPdfCopyBtn" type="button" class="px-4 py-3 rounded-xl bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-100 font-semibold hover:bg-slate-200 dark:hover:bg-slate-700 transition">Copy Text</button>
            <button id="ocrPdfDownloadBtn" type="button" class="px-4 py-3 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition">Download TXT</button>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script src="https://unpkg.com/tesseract.js@4.0.2/dist/tesseract.min.js"></script>
    <script>
        if (window.pdfjsLib) {
            window.pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";
        }

        const ocrPdfInput = document.getElementById("ocrPdfInput");
        const ocrPdfBtn = document.getElementById("ocrPdfBtn");
        const ocrPdfStatus = document.getElementById("ocrPdfStatus");
        const ocrPdfOutput = document.getElementById("ocrPdfOutput");
        const ocrPdfActions = document.getElementById("ocrPdfActions");
        const ocrPdfCopyBtn = document.getElementById("ocrPdfCopyBtn");
        const ocrPdfDownloadBtn = document.getElementById("ocrPdfDownloadBtn");
        const ocrPdfPreview = document.getElementById("ocrPdfPreview");

        function setOcrStatus(message, isError) {
            if (!message) {
                ocrPdfStatus.textContent = "";
                ocrPdfStatus.classList.add("hidden");
                ocrPdfStatus.classList.remove("text-red-500");
                return;
            }

            ocrPdfStatus.textContent = message;
            ocrPdfStatus.classList.remove("hidden");
            ocrPdfStatus.classList.toggle("text-red-500", !!isError);
        }

        function normalizeOcrText(value) {
            return String(value || "")
                .replace(/\r/g, " ")
                .replace(/\t/g, " ")
                .replace(/[ ]{2,}/g, " ")
                .replace(/\n{3,}/g, "\n\n")
                .trim();
        }

        function buildOcrTextFromItems(items) {
            const rows = {};
            let usefulItemCount = 0;

            items.forEach(function(item) {
                const text = normalizeOcrText(item && item.str ? item.str : "");
                if (!text) return;

                usefulItemCount += text.length;
                const y = Math.round(item.transform && item.transform[5] ? item.transform[5] : 0);
                if (!rows[y]) rows[y] = [];
                rows[y].push({
                    x: item.transform && item.transform[4] ? item.transform[4] : 0,
                    text: text
                });
            });

            const lines = Object.keys(rows)
                .map(function(key) { return parseInt(key, 10); })
                .sort(function(a, b) { return b - a; })
                .map(function(y) {
                    return rows[y]
                        .sort(function(a, b) { return a.x - b.x; })
                        .map(function(part) { return part.text; })
                        .join(" ");
                })
                .filter(Boolean);

            return {
                text: normalizeOcrText(lines.join("\n")),
                usefulItemCount: usefulItemCount
            };
        }

        async function extractPageText(page) {
            const textContent = await page.getTextContent({ normalizeWhitespace: true });
            const built = buildOcrTextFromItems(textContent.items || []);
            return built;
        }

        async function runPageOcr(page) {
            const viewport = page.getViewport({ scale: 2.2 });
            const canvas = document.createElement("canvas");
            const context = canvas.getContext("2d", { alpha: false });

            canvas.width = Math.ceil(viewport.width);
            canvas.height = Math.ceil(viewport.height);
            context.fillStyle = "#FFFFFF";
            context.fillRect(0, 0, canvas.width, canvas.height);

            await page.render({
                canvasContext: context,
                viewport: viewport
            }).promise;

            const result = await Tesseract.recognize(canvas, "eng");
            return normalizeOcrText(result && result.data ? result.data.text : "");
        }

        function getOcrBaseName(fileName) {
            let baseName = fileName || "ocr-pdf";
            if (baseName.toLowerCase().slice(-4) === ".pdf") {
                baseName = baseName.slice(0, -4);
            }
            return baseName || "ocr-pdf";
        }

        ocrPdfInput.addEventListener("change", function() {
            const file = this.files && this.files[0] ? this.files[0] : null;
            ocrPdfOutput.value = "";
            ocrPdfOutput.classList.add("hidden");
            ocrPdfActions.classList.add("hidden");
            setOcrStatus("");

            if (!file) {
                ocrPdfPreview.textContent = "";
                ocrPdfPreview.classList.add("hidden");
                return;
            }

            ocrPdfPreview.textContent = file.name + " selected for OCR PDF conversion";
            ocrPdfPreview.classList.remove("hidden");
        });

        ocrPdfCopyBtn.addEventListener("click", async function() {
            if (!ocrPdfOutput.value) return;

            try {
                await navigator.clipboard.writeText(ocrPdfOutput.value);
                setOcrStatus("OCR text copied to clipboard.");
            } catch (error) {
                setOcrStatus("Could not copy OCR text automatically. Please copy it manually.", true);
            }
        });

        ocrPdfDownloadBtn.addEventListener("click", function() {
            if (!ocrPdfOutput.value) return;

            const file = ocrPdfInput.files && ocrPdfInput.files[0] ? ocrPdfInput.files[0] : null;
            const baseName = getOcrBaseName(file ? file.name : "");
            const blob = new Blob([ocrPdfOutput.value], { type: "text/plain;charset=utf-8" });
            const url = URL.createObjectURL(blob);
            const a = document.createElement("a");
            a.href = url;
            a.download = baseName + "_ocr.txt";
            a.click();
            URL.revokeObjectURL(url);
        });

        ocrPdfBtn.addEventListener("click", async function() {
            const file = ocrPdfInput.files && ocrPdfInput.files[0] ? ocrPdfInput.files[0] : null;
            if (!file) {
                alert("Please select a PDF file");
                return;
            }

            try {
                if (!window.pdfjsLib) {
                    throw new Error("PDF library failed to load.");
                }
                if (!window.Tesseract) {
                    throw new Error("OCR library failed to load.");
                }

                ocrPdfOutput.value = "";
                ocrPdfOutput.classList.remove("hidden");
                ocrPdfActions.classList.add("hidden");
                setOcrStatus("Loading PDF for OCR...");

                const pdf = await window.pdfjsLib.getDocument({ data: await file.arrayBuffer() }).promise;
                const pageTexts = [];

                for (let i = 1; i <= pdf.numPages; i++) {
                    const page = await pdf.getPage(i);
                    setOcrStatus("Reading page " + i + " of " + pdf.numPages + "...");

                    const extracted = await extractPageText(page);
                    let pageText = extracted.text;

                    if (!pageText || extracted.usefulItemCount < 30) {
                        setOcrStatus("Running OCR on page " + i + " of " + pdf.numPages + "...");
                        pageText = await runPageOcr(page);
                    }

                    if (pageText) {
                        pageTexts.push(pageText);
                    }
                }

                ocrPdfOutput.value = pageTexts.join("\n\n").trim();
                ocrPdfActions.classList.toggle("hidden", !ocrPdfOutput.value);

                if (ocrPdfOutput.value) {
                    setOcrStatus("OCR complete. Text extracted successfully.");
                } else {
                    setOcrStatus("OCR finished, but no readable text was found in this PDF.", true);
                }
            } catch (error) {
                setOcrStatus("Error while running OCR: " + error.message, true);
            }
        });
    </script>';
}

function getRotatePdfHTML() {
    return '
    <div class="space-y-6">
        <div style="display:none;">
            <h1>Rotate PDF Online Free - Rotate PDF Pages</h1>
            <p>Use this rotate PDF tool to rotate PDF pages online free, permanently rotate PDF files, and save your updated document after visual page editing.</p>
            <p>Rotate PDF file pages on Mac, Windows, and mobile browsers with per-page controls or apply one angle to all pages at once.</p>
        </div>
        <div class="rounded-2xl border border-gray-200 dark:border-gray-700 p-5 space-y-4 bg-white dark:bg-gray-900">
            <div>
                <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">Rotate PDF Pages</div>
                <p class="text-sm text-gray-500 mt-1">Upload a PDF, preview each page, rotate pages left or right visually, apply an angle to all pages if needed, and download the rotated PDF.</p>
            </div>
            <input type="file" id="rotatePdfInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
            <div id="rotatePdfStatus" class="hidden text-sm text-gray-500 text-center"></div>
            <div id="rotatePdfToolbar" class="hidden flex flex-wrap gap-3">
                <select id="rotatePdfAngle" class="px-4 py-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                    <option value="90">Rotate all 90° right</option>
                    <option value="180">Rotate all 180°</option>
                    <option value="270">Rotate all 90° left</option>
                </select>
                <button id="rotatePdfApplyAllBtn" type="button" class="px-4 py-3 rounded-xl bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-100 font-semibold hover:bg-slate-200 dark:hover:bg-slate-700 transition">Apply to All Pages</button>
                <button id="rotatePdfResetBtn" type="button" class="px-4 py-3 rounded-xl bg-amber-100 text-amber-900 dark:bg-amber-900/30 dark:text-amber-200 font-semibold hover:bg-amber-200 dark:hover:bg-amber-900/50 transition">Reset Rotations</button>
                <button id="rotatePdfBtn" type="button" class="px-4 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">Rotate PDF and Save</button>
            </div>
        </div>
        <div class="rounded-2xl border border-blue-100 bg-blue-50/70 dark:bg-blue-950/20 dark:border-blue-900 p-4 text-sm text-blue-900 dark:text-blue-100">
            How to rotate PDF:
            Upload the file, rotate PDF pages visually, and save your changes so the PDF stays permanently rotated.
        </div>
        <div id="rotatePdfEmpty" class="rounded-2xl border border-dashed border-gray-300 dark:border-gray-700 p-8 text-center text-sm text-gray-500">PDF page thumbnails will appear here after upload so you can rotate PDF pages online.</div>
        <div id="rotatePdfGrid" class="hidden grid sm:grid-cols-2 xl:grid-cols-3 gap-4"></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";

        const rotatePdfInput = document.getElementById("rotatePdfInput");
        const rotatePdfStatus = document.getElementById("rotatePdfStatus");
        const rotatePdfToolbar = document.getElementById("rotatePdfToolbar");
        const rotatePdfGrid = document.getElementById("rotatePdfGrid");
        const rotatePdfEmpty = document.getElementById("rotatePdfEmpty");
        const rotatePdfAngle = document.getElementById("rotatePdfAngle");
        const rotatePdfApplyAllBtn = document.getElementById("rotatePdfApplyAllBtn");
        const rotatePdfResetBtn = document.getElementById("rotatePdfResetBtn");
        const rotatePdfSaveBtn = document.getElementById("rotatePdfBtn");

        let rotatePdfBytes = null;
        let rotatePdfDoc = null;
        let rotatePdfViewDoc = null;
        let rotatePdfItems = [];

        function setRotatePdfStatus(message, isError) {
            if (!message) {
                rotatePdfStatus.textContent = "";
                rotatePdfStatus.classList.add("hidden");
                rotatePdfStatus.classList.remove("text-red-500");
                return;
            }

            rotatePdfStatus.textContent = message;
            rotatePdfStatus.classList.remove("hidden");
            rotatePdfStatus.classList.toggle("text-red-500", !!isError);
        }

        function updateRotatePdfVisibility() {
            const hasItems = rotatePdfItems.length > 0;
            rotatePdfGrid.classList.toggle("hidden", !hasItems);
            rotatePdfToolbar.classList.toggle("hidden", !hasItems);
            rotatePdfEmpty.classList.toggle("hidden", hasItems);
            if (!hasItems) {
                rotatePdfEmpty.textContent = "PDF page thumbnails will appear here after upload so you can rotate PDF pages online.";
            }
        }

        async function renderRotateThumbnail(item, canvas) {
            if (!rotatePdfViewDoc) return;
            const page = await rotatePdfViewDoc.getPage(item.sourceIndex + 1);
            const viewport = page.getViewport({ scale: 0.32, rotation: item.rotation });
            const context = canvas.getContext("2d");
            canvas.width = Math.ceil(viewport.width);
            canvas.height = Math.ceil(viewport.height);
            context.fillStyle = "#ffffff";
            context.fillRect(0, 0, canvas.width, canvas.height);
            await page.render({ canvasContext: context, viewport: viewport }).promise;
        }

        function normalizeRotation(value) {
            let angle = value % 360;
            if (angle < 0) angle += 360;
            return angle;
        }

        function createRotatePageCard(item, index) {
            const card = document.createElement("div");
            card.className = "rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 shadow-sm overflow-hidden";

            const preview = document.createElement("div");
            preview.className = "aspect-[3/4] bg-gray-100 dark:bg-gray-800 flex items-center justify-center overflow-hidden";

            const canvas = document.createElement("canvas");
            canvas.className = "w-full h-full object-contain bg-white";
            preview.appendChild(canvas);

            const body = document.createElement("div");
            body.className = "p-4 space-y-3";

            const info = document.createElement("div");
            info.innerHTML = "<div class=\"text-xs uppercase tracking-[0.18em] text-gray-400\">Page " + (index + 1) + "</div><div class=\"mt-1 text-sm font-semibold text-gray-900 dark:text-gray-100\">Original PDF page " + (item.sourceIndex + 1) + "</div>";

            const angleBadge = document.createElement("div");
            angleBadge.className = "text-xs font-semibold text-blue-700 dark:text-blue-300";

            const controls = document.createElement("div");
            controls.className = "flex flex-wrap gap-2";

            const leftBtn = document.createElement("button");
            leftBtn.type = "button";
            leftBtn.className = "px-3 py-2 rounded-lg bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-100 text-xs font-semibold";
            leftBtn.textContent = "Rotate Left";

            const rightBtn = document.createElement("button");
            rightBtn.type = "button";
            rightBtn.className = "px-3 py-2 rounded-lg bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-100 text-xs font-semibold";
            rightBtn.textContent = "Rotate Right";

            const flipBtn = document.createElement("button");
            flipBtn.type = "button";
            flipBtn.className = "px-3 py-2 rounded-lg bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-100 text-xs font-semibold";
            flipBtn.textContent = "Rotate 180°";

            function refreshCard() {
                angleBadge.textContent = "Current rotation: " + item.rotation + "°";
                renderRotateThumbnail(item, canvas);
            }

            leftBtn.addEventListener("click", function() {
                item.rotation = normalizeRotation(item.rotation - 90);
                refreshCard();
            });

            rightBtn.addEventListener("click", function() {
                item.rotation = normalizeRotation(item.rotation + 90);
                refreshCard();
            });

            flipBtn.addEventListener("click", function() {
                item.rotation = normalizeRotation(item.rotation + 180);
                refreshCard();
            });

            controls.appendChild(leftBtn);
            controls.appendChild(rightBtn);
            controls.appendChild(flipBtn);
            body.appendChild(info);
            body.appendChild(angleBadge);
            body.appendChild(controls);
            card.appendChild(preview);
            card.appendChild(body);

            refreshCard();
            return card;
        }

        function renderRotatePdfGrid() {
            rotatePdfGrid.innerHTML = "";
            updateRotatePdfVisibility();
            rotatePdfItems.forEach(function(item, index) {
                rotatePdfGrid.appendChild(createRotatePageCard(item, index));
            });
        }

        rotatePdfInput.addEventListener("change", async function() {
            const file = this.files[0];
            if (!file) return;

            try {
                setRotatePdfStatus("Loading PDF pages...");
                rotatePdfBytes = await file.arrayBuffer();
                rotatePdfDoc = await PDFLib.PDFDocument.load(rotatePdfBytes);
                rotatePdfViewDoc = await pdfjsLib.getDocument({ data: rotatePdfBytes }).promise;
                rotatePdfItems = [];

                for (let i = 0; i < rotatePdfDoc.getPageCount(); i++) {
                    rotatePdfItems.push({
                        sourceIndex: i,
                        rotation: 0
                    });
                }

                renderRotatePdfGrid();
                setRotatePdfStatus("Rotate PDF pages visually, or apply one angle to all pages.");
            } catch (error) {
                rotatePdfItems = [];
                renderRotatePdfGrid();
                setRotatePdfStatus("Could not load this PDF: " + error.message, true);
            }
        });

        rotatePdfApplyAllBtn.addEventListener("click", function() {
            const angle = parseInt(rotatePdfAngle.value || "90", 10);
            if (!rotatePdfItems.length) return;
            rotatePdfItems.forEach(function(item) {
                item.rotation = normalizeRotation(item.rotation + angle);
            });
            renderRotatePdfGrid();
            setRotatePdfStatus("Applied " + angle + "° rotation to all pages.");
        });

        rotatePdfResetBtn.addEventListener("click", function() {
            rotatePdfItems.forEach(function(item) {
                item.rotation = 0;
            });
            renderRotatePdfGrid();
            setRotatePdfStatus("All page rotations reset.");
        });

        rotatePdfSaveBtn.addEventListener("click", async function() {
            if (!rotatePdfInput.files.length || !rotatePdfItems.length) return alert("Please select a PDF file");

            try {
                setRotatePdfStatus("Saving rotated PDF...");
                const pdf = await PDFLib.PDFDocument.load(rotatePdfBytes);
                pdf.getPages().forEach(function(page, index) {
                    page.setRotation(PDFLib.degrees(rotatePdfItems[index].rotation));
                });

                const bytes = await pdf.save();
                const file = rotatePdfInput.files[0];
                const baseName = file && file.name ? file.name.replace(/\.pdf$/i, "") : "rotated";
                const a = document.createElement("a");
                a.href = URL.createObjectURL(new Blob([bytes], { type: "application/pdf" }));
                a.download = baseName + "-rotated.pdf";
                a.click();
                setRotatePdfStatus("Rotated PDF ready. Your file has been downloaded.");
            } catch (error) {
                setRotatePdfStatus("Could not rotate this PDF: " + error.message, true);
            }
        });
    </script>';
}

function getAddPageNumbersHTML() {
    return '
    <div class="space-y-6">
        <div style="display:none;">
            <h1>Add Page Number to PDF Online Free</h1>
            <p>Use this tool to add page number to PDF online free, number PDF pages in your browser, and download the updated PDF file with page numbering applied.</p>
            <p>Learn how to add page number to PDF document files on Mac, Windows, and mobile using a simple add page number to PDF free workflow.</p>
        </div>
        <div class="rounded-2xl border border-gray-200 dark:border-gray-700 p-5 space-y-4 bg-white dark:bg-gray-900">
            <div>
                <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">Add Page Number to PDF</div>
                <p class="text-sm text-gray-500 mt-1">Upload a PDF, add page numbers automatically, and download the updated file in seconds.</p>
            </div>
            <input type="file" id="pageNumbersInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
            <button id="pageNumbersBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Add Page Number to PDF Free</button>
        </div>
        <div class="rounded-2xl border border-blue-100 bg-blue-50/70 dark:bg-blue-950/20 dark:border-blue-900 p-4 text-sm text-blue-900 dark:text-blue-100">
            How to add page number to PDF:
            Upload the PDF file, click the button to add page numbers, and download the numbered document.
        </div>
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
        <div style="display:none;">
            <h1>Add Watermark to PDF Online Free</h1>
            <p>Add watermark to PDF online free with text or image watermark placement, choose a position visually, and download the updated PDF in your browser.</p>
            <p>Use this PDF watermark tool to add watermark to PDF files, place text or logo marks on every page, and preview the watermark before downloading.</p>
        </div>
        <div class="rounded-2xl border border-gray-200 dark:border-gray-700 p-5 space-y-4 bg-white dark:bg-gray-900">
            <div>
                <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">Add Watermark to PDF</div>
                <p class="text-sm text-gray-500 mt-1">Upload a PDF, preview all pages, choose watermark text or image, pick a position, and download the watermarked PDF.</p>
            </div>
            <input type="file" id="watermarkPdfInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
            <div id="watermarkStatus" class="hidden text-sm text-gray-500 text-center"></div>
            <div id="watermarkControls" class="hidden grid md:grid-cols-2 gap-4">
                <select id="watermarkType" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                    <option value="text">Text Watermark</option>
                    <option value="image">Image Watermark</option>
                </select>
                <select id="watermarkPosition" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                    <option value="center">Center</option>
                    <option value="top-left">Top Left</option>
                    <option value="top-center">Top Center</option>
                    <option value="top-right">Top Right</option>
                    <option value="middle-left">Middle Left</option>
                    <option value="middle-right">Middle Right</option>
                    <option value="bottom-left">Bottom Left</option>
                    <option value="bottom-center">Bottom Center</option>
                    <option value="bottom-right">Bottom Right</option>
                </select>
                <input type="text" id="watermarkText" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Enter watermark text">
                <input type="file" id="watermarkImageInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept="image/*">
                <input type="number" id="watermarkFontSize" min="12" max="96" value="36" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Text size">
                <input type="number" id="watermarkOpacity" min="10" max="100" value="35" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Opacity percent">
            </div>
            <button id="watermarkPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Add Watermark to PDF Free</button>
        </div>
        <div class="rounded-2xl border border-blue-100 bg-blue-50/70 dark:bg-blue-950/20 dark:border-blue-900 p-4 text-sm text-blue-900 dark:text-blue-100">
            How to add watermark to PDF:
            Upload the PDF, choose text or image watermark content, pick a position, preview the watermark on all pages, and download the updated PDF.
        </div>
        <div id="watermarkEmpty" class="rounded-2xl border border-dashed border-gray-300 dark:border-gray-700 p-8 text-center text-sm text-gray-500">PDF page previews will appear here after upload so you can place the watermark visually before download.</div>
        <div id="watermarkGrid" class="hidden grid sm:grid-cols-2 xl:grid-cols-3 gap-4"></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";

        const watermarkPdfInput = document.getElementById("watermarkPdfInput");
        const watermarkType = document.getElementById("watermarkType");
        const watermarkPosition = document.getElementById("watermarkPosition");
        const watermarkTextInput = document.getElementById("watermarkText");
        const watermarkImageInput = document.getElementById("watermarkImageInput");
        const watermarkFontSize = document.getElementById("watermarkFontSize");
        const watermarkOpacity = document.getElementById("watermarkOpacity");
        const watermarkPdfBtn = document.getElementById("watermarkPdfBtn");
        const watermarkStatus = document.getElementById("watermarkStatus");
        const watermarkControls = document.getElementById("watermarkControls");
        const watermarkGrid = document.getElementById("watermarkGrid");
        const watermarkEmpty = document.getElementById("watermarkEmpty");

        let watermarkPdfBytes = null;
        let watermarkPdfDoc = null;
        let watermarkViewDoc = null;
        let watermarkPages = [];
        let watermarkImageBytes = null;
        let watermarkImageUrl = "";

        function setWatermarkStatus(message, isError) {
            if (!message) {
                watermarkStatus.textContent = "";
                watermarkStatus.classList.add("hidden");
                watermarkStatus.classList.remove("text-red-500");
                return;
            }

            watermarkStatus.textContent = message;
            watermarkStatus.classList.remove("hidden");
            watermarkStatus.classList.toggle("text-red-500", !!isError);
        }

        function updateWatermarkVisibility() {
            const hasPages = watermarkPages.length > 0;
            watermarkControls.classList.toggle("hidden", !hasPages);
            watermarkGrid.classList.toggle("hidden", !hasPages);
            watermarkEmpty.classList.toggle("hidden", hasPages);
        }

        function getWatermarkBaseName(name) {
            let baseName = name || "watermarked";
            if (baseName.toLowerCase().slice(-4) === ".pdf") {
                baseName = baseName.slice(0, -4);
            }
            return baseName || "watermarked";
        }

        function getWatermarkPositionClass(position) {
            const map = {
                "center": "top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2",
                "top-left": "top-4 left-4",
                "top-center": "top-4 left-1/2 -translate-x-1/2",
                "top-right": "top-4 right-4",
                "middle-left": "top-1/2 left-4 -translate-y-1/2",
                "middle-right": "top-1/2 right-4 -translate-y-1/2",
                "bottom-left": "bottom-4 left-4",
                "bottom-center": "bottom-4 left-1/2 -translate-x-1/2",
                "bottom-right": "bottom-4 right-4"
            };
            return map[position] || map.center;
        }

        function getWatermarkCoordinates(pageWidth, pageHeight, boxWidth, boxHeight, position) {
            const marginX = Math.max(18, pageWidth * 0.04);
            const marginY = Math.max(18, pageHeight * 0.04);

            if (position === "top-left") return { x: marginX, y: pageHeight - marginY - boxHeight };
            if (position === "top-center") return { x: (pageWidth - boxWidth) / 2, y: pageHeight - marginY - boxHeight };
            if (position === "top-right") return { x: pageWidth - marginX - boxWidth, y: pageHeight - marginY - boxHeight };
            if (position === "middle-left") return { x: marginX, y: (pageHeight - boxHeight) / 2 };
            if (position === "middle-right") return { x: pageWidth - marginX - boxWidth, y: (pageHeight - boxHeight) / 2 };
            if (position === "bottom-left") return { x: marginX, y: marginY };
            if (position === "bottom-center") return { x: (pageWidth - boxWidth) / 2, y: marginY };
            if (position === "bottom-right") return { x: pageWidth - marginX - boxWidth, y: marginY };
            return { x: (pageWidth - boxWidth) / 2, y: (pageHeight - boxHeight) / 2 };
        }

        async function renderWatermarkThumbnail(item, canvas) {
            if (!watermarkViewDoc) return;

            const page = await watermarkViewDoc.getPage(item.pageNumber);
            const viewport = page.getViewport({ scale: 0.34 });
            const context = canvas.getContext("2d");
            canvas.width = Math.ceil(viewport.width);
            canvas.height = Math.ceil(viewport.height);
            context.fillStyle = "#ffffff";
            context.fillRect(0, 0, canvas.width, canvas.height);
            await page.render({ canvasContext: context, viewport: viewport }).promise;
        }

        function buildWatermarkPreviewElement() {
            const type = watermarkType.value;
            const positionClass = getWatermarkPositionClass(watermarkPosition.value);
            const opacityValue = Math.max(10, Math.min(100, parseInt(watermarkOpacity.value || "35", 10))) / 100;

            const overlay = document.createElement("div");
            overlay.className = "absolute pointer-events-none z-10 max-w-[80%] " + positionClass;
            overlay.style.opacity = String(opacityValue);

            if (type === "image" && watermarkImageUrl) {
                const image = document.createElement("img");
                image.src = watermarkImageUrl;
                image.className = "max-w-[150px] max-h-[150px] object-contain";
                overlay.appendChild(image);
                return overlay;
            }

            const text = (watermarkTextInput.value || "").trim() || "Sample Watermark";
            const textBox = document.createElement("div");
            textBox.className = "px-3 py-2 rounded-lg bg-slate-900/10 text-slate-700 font-semibold text-center break-words";
            textBox.style.fontSize = Math.max(12, Math.min(96, parseInt(watermarkFontSize.value || "36", 10))) / 3 + "px";
            textBox.style.transform = "rotate(-25deg)";
            textBox.textContent = text;
            overlay.appendChild(textBox);
            return overlay;
        }

        function createWatermarkCard(item) {
            const card = document.createElement("div");
            card.className = "rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 shadow-sm overflow-hidden";

            const preview = document.createElement("div");
            preview.className = "relative aspect-[3/4] bg-gray-100 dark:bg-gray-800 flex items-center justify-center overflow-hidden";

            const canvas = document.createElement("canvas");
            canvas.className = "w-full h-full object-contain bg-white";
            preview.appendChild(canvas);
            preview.appendChild(buildWatermarkPreviewElement());

            const body = document.createElement("div");
            body.className = "p-4";
            body.innerHTML = "<div class=\"text-xs uppercase tracking-[0.18em] text-gray-400\">Page " + item.pageNumber + "</div><div class=\"mt-1 text-sm font-semibold text-gray-900 dark:text-gray-100\">Watermark preview</div>";

            card.appendChild(preview);
            card.appendChild(body);
            renderWatermarkThumbnail(item, canvas);
            return card;
        }

        function renderWatermarkGrid() {
            watermarkGrid.innerHTML = "";
            updateWatermarkVisibility();

            watermarkPages.forEach(function(item) {
                watermarkGrid.appendChild(createWatermarkCard(item));
            });
        }

        function refreshWatermarkPreview() {
            if (!watermarkPages.length) return;
            renderWatermarkGrid();
        }

        watermarkType.addEventListener("change", function() {
            const isImage = watermarkType.value === "image";
            watermarkTextInput.disabled = isImage;
            watermarkImageInput.disabled = !isImage;
            refreshWatermarkPreview();
        });

        watermarkPosition.addEventListener("change", refreshWatermarkPreview);
        watermarkTextInput.addEventListener("input", refreshWatermarkPreview);
        watermarkFontSize.addEventListener("input", refreshWatermarkPreview);
        watermarkOpacity.addEventListener("input", refreshWatermarkPreview);

        watermarkImageInput.addEventListener("change", async function() {
            const file = this.files && this.files[0] ? this.files[0] : null;
            watermarkImageBytes = null;
            watermarkImageUrl = "";

            if (!file) {
                refreshWatermarkPreview();
                return;
            }

            watermarkImageBytes = await file.arrayBuffer();
            watermarkImageUrl = URL.createObjectURL(file);
            refreshWatermarkPreview();
        });

        watermarkPdfInput.addEventListener("change", async function() {
            const file = this.files && this.files[0] ? this.files[0] : null;
            watermarkPages = [];
            watermarkPdfBytes = null;
            watermarkPdfDoc = null;
            watermarkViewDoc = null;
            renderWatermarkGrid();

            if (!file) {
                setWatermarkStatus("");
                return;
            }

            try {
                setWatermarkStatus("Loading PDF pages...");
                watermarkPdfBytes = await file.arrayBuffer();
                watermarkPdfDoc = await PDFLib.PDFDocument.load(watermarkPdfBytes);
                watermarkViewDoc = await pdfjsLib.getDocument({ data: watermarkPdfBytes }).promise;
                for (let i = 1; i <= watermarkPdfDoc.getPageCount(); i++) {
                    watermarkPages.push({ pageNumber: i });
                }
                renderWatermarkGrid();
                setWatermarkStatus("Choose the watermark content and position, then download the watermarked PDF.");
            } catch (error) {
                setWatermarkStatus("Could not load this PDF: " + error.message, true);
            }
        });

        watermarkPdfBtn.addEventListener("click", async function() {
            const file = watermarkPdfInput.files && watermarkPdfInput.files[0] ? watermarkPdfInput.files[0] : null;
            if (!file) {
                alert("Please select a PDF file");
                return;
            }

            const type = watermarkType.value;
            const watermarkText = (watermarkTextInput.value || "").trim();
            if (type === "text" && !watermarkText) {
                alert("Please enter watermark text.");
                return;
            }
            if (type === "image" && !watermarkImageBytes) {
                alert("Please choose a watermark image.");
                return;
            }

            try {
                setWatermarkStatus("Applying watermark to PDF...");
                const pdf = await PDFLib.PDFDocument.load(watermarkPdfBytes);
                const opacityValue = Math.max(10, Math.min(100, parseInt(watermarkOpacity.value || "35", 10))) / 100;
                const position = watermarkPosition.value;
                let embeddedImage = null;
                let font = null;

                if (type === "image") {
                    const imageFile = watermarkImageInput.files && watermarkImageInput.files[0] ? watermarkImageInput.files[0] : null;
                    if (!imageFile) throw new Error("Watermark image is missing.");
                    if ((imageFile.type || "").toLowerCase().indexOf("png") !== -1) {
                        embeddedImage = await pdf.embedPng(watermarkImageBytes);
                    } else {
                        embeddedImage = await pdf.embedJpg(watermarkImageBytes);
                    }
                } else {
                    font = await pdf.embedFont(PDFLib.StandardFonts.HelveticaBold);
                }

                pdf.getPages().forEach(function(page) {
                    const pageWidth = page.getWidth();
                    const pageHeight = page.getHeight();

                    if (type === "image" && embeddedImage) {
                        const maxWidth = pageWidth * 0.28;
                        const scale = Math.min(maxWidth / embeddedImage.width, (pageHeight * 0.22) / embeddedImage.height, 1);
                        const width = embeddedImage.width * scale;
                        const height = embeddedImage.height * scale;
                        const point = getWatermarkCoordinates(pageWidth, pageHeight, width, height, position);
                        page.drawImage(embeddedImage, {
                            x: point.x,
                            y: point.y,
                            width: width,
                            height: height,
                            opacity: opacityValue
                        });
                    } else {
                        const fontSizeValue = Math.max(12, Math.min(96, parseInt(watermarkFontSize.value || "36", 10)));
                        const size = Math.min(fontSizeValue, pageWidth / 6);
                        const textWidth = font.widthOfTextAtSize(watermarkText, size);
                        const textHeight = size;
                        const point = getWatermarkCoordinates(pageWidth, pageHeight, textWidth, textHeight, position);
                        page.drawText(watermarkText, {
                            x: point.x,
                            y: point.y,
                            size: size,
                            font: font,
                            color: PDFLib.rgb(0.45, 0.45, 0.45),
                            rotate: PDFLib.degrees(position === "center" ? 325 : 0),
                            opacity: opacityValue
                        });
                    }
                });

                const bytes = await pdf.save();
                const a = document.createElement("a");
                a.href = URL.createObjectURL(new Blob([bytes], { type: "application/pdf" }));
                a.download = getWatermarkBaseName(file.name) + "_watermarked.pdf";
                a.click();
                setWatermarkStatus("Watermark added successfully. PDF downloaded.");
            } catch (error) {
                setWatermarkStatus("Could not add watermark: " + error.message, true);
            }
        });

        watermarkType.dispatchEvent(new Event("change"));
    </script>';
}

function getUnlockPdfHTML() {
    return '
    <div class="space-y-6">
        <div style="display:none;">
            <h1>Unlock PDF Online Free</h1>
            <p>Use this unlock PDF tool to unlock PDF files online free, enter the PDF password, and download an unlocked PDF document for viewing or editing.</p>
            <p>Learn how to unlock PDF, unlock PDF for editing, and unlock PDF password protected files in your browser with a simple upload and password flow.</p>
        </div>
        <div class="rounded-2xl border border-gray-200 dark:border-gray-700 p-5 space-y-4 bg-white dark:bg-gray-900">
            <div>
                <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">Unlock PDF File</div>
                <p class="text-sm text-gray-500 mt-1">Upload a protected PDF, enter the password if required, and download a new unlocked copy.</p>
            </div>
            <input type="file" id="unlockPdfInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
            <input type="password" id="unlockPdfPassword" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Enter PDF password if the file is locked">
            <button id="unlockPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Unlock PDF Free</button>
            <div id="unlockPdfStatus" class="hidden text-sm text-gray-500 text-center"></div>
        </div>
        <div class="rounded-2xl border border-blue-100 bg-blue-50/70 dark:bg-blue-950/20 dark:border-blue-900 p-4 text-sm text-blue-900 dark:text-blue-100">
            How to unlock PDF:
            Upload the locked PDF, enter the correct password, let the tool open and rebuild the document, then download the unlocked PDF file.
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";
        const unlockPdfInput = document.getElementById("unlockPdfInput");
        const unlockPdfPassword = document.getElementById("unlockPdfPassword");
        const unlockPdfStatus = document.getElementById("unlockPdfStatus");
        const unlockPdfBtn = document.getElementById("unlockPdfBtn");

        function setUnlockPdfStatus(message, isError) {
            if (!message) {
                unlockPdfStatus.textContent = "";
                unlockPdfStatus.classList.add("hidden");
                unlockPdfStatus.classList.remove("text-red-500");
                return;
            }

            unlockPdfStatus.textContent = message;
            unlockPdfStatus.classList.remove("hidden");
            unlockPdfStatus.classList.toggle("text-red-500", !!isError);
        }

        function getUnlockPdfBaseName(name) {
            let baseName = name || "unlocked";
            if (baseName.toLowerCase().slice(-4) === ".pdf") {
                baseName = baseName.slice(0, -4);
            }
            return baseName || "unlocked";
        }

        unlockPdfBtn.addEventListener("click", async function() {
            const file = unlockPdfInput.files && unlockPdfInput.files[0] ? unlockPdfInput.files[0] : null;
            if (!file) {
                alert("Please select a PDF file");
                return;
            }

            const password = (unlockPdfPassword.value || "").trim();
            const { jsPDF } = window.jspdf;

            try {
                setUnlockPdfStatus("Opening PDF...");
                const sourceBytes = await file.arrayBuffer();
                const loadingTask = pdfjsLib.getDocument({
                    data: sourceBytes,
                    password: password || undefined
                });
                const pdf = await loadingTask.promise;
                let doc = null;

                for (let i = 1; i <= pdf.numPages; i++) {
                    setUnlockPdfStatus("Unlocking page " + i + " of " + pdf.numPages + "...");
                    const page = await pdf.getPage(i);
                    const viewport = page.getViewport({ scale: 1.8 });
                    const canvas = document.createElement("canvas");
                    const canvasCtx = canvas.getContext("2d", { alpha: false });
                    canvas.width = Math.ceil(viewport.width);
                    canvas.height = Math.ceil(viewport.height);
                    canvasCtx.fillStyle = "#FFFFFF";
                    canvasCtx.fillRect(0, 0, canvas.width, canvas.height);
                    canvasCtx.imageSmoothingEnabled = true;
                    canvasCtx.imageSmoothingQuality = "high";

                    await page.render({
                        canvasContext: canvasCtx,
                        viewport: viewport
                    }).promise;

                    const orientation = viewport.width > viewport.height ? "landscape" : "portrait";
                    const pageFormat = [Math.ceil(viewport.width), Math.ceil(viewport.height)];
                    if (!doc) {
                        doc = new jsPDF({
                            orientation: orientation,
                            unit: "pt",
                            format: pageFormat,
                            compress: true
                        });
                    } else {
                        doc.addPage(pageFormat, orientation);
                    }

                    const img = canvas.toDataURL("image/jpeg", 0.96);
                    doc.addImage(img, "JPEG", 0, 0, pageFormat[0], pageFormat[1]);
                }

                if (!doc) {
                    throw new Error("No pages were found in this PDF.");
                }

                doc.save(getUnlockPdfBaseName(file.name) + "_unlocked.pdf");
                setUnlockPdfStatus("Unlock complete. Unlocked PDF downloaded.");
            } catch (error) {
                let message = error && error.message ? error.message : "Could not unlock this PDF.";
                if (message.toLowerCase().indexOf("password") !== -1) {
                    message = "This PDF is password protected. Enter the correct password and try again.";
                }
                setUnlockPdfStatus(message, true);
            }
        });
    </script>';
}

function getSignPdfHTML() {
    return '
    <div class="space-y-6">
        <div style="display:none;">
            <h1>Sign PDF Online Free - E Sign PDF</h1>
            <p>Use this sign PDF tool to sign PDF online free, create a PDF signature, e sign PDF documents, and place signatures visually on the page before downloading.</p>
            <p>Create a free PDF signature, draw a digital PDF signature, type an e sign, fill and sign PDF files, and sign PDF documents in your browser.</p>
        </div>
        <div class="rounded-2xl border border-gray-200 dark:border-gray-700 p-5 space-y-4 bg-white dark:bg-gray-900">
            <div>
                <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">Sign PDF Documents</div>
                <p class="text-sm text-gray-500 mt-1">Upload a PDF, type or draw your signature, drag it onto any page, and download the signed PDF.</p>
            </div>
            <input type="file" id="signPdfInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
            <div id="signPdfStatus" class="hidden text-sm text-gray-500 text-center"></div>
            <div id="signPdfControls" class="hidden space-y-4">
                <div class="grid md:grid-cols-2 gap-4">
                    <select id="signatureMode" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                        <option value="text">Type Signature</option>
                        <option value="draw">Draw Signature</option>
                    </select>
                    <select id="signatureFontStyle" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                        <option value="script">Script Style</option>
                        <option value="classic">Classic Style</option>
                        <option value="clean">Clean Style</option>
                        <option value="bold">Bold Style</option>
                    </select>
                </div>
                <div id="signatureTextWrap">
                    <input type="text" id="signatureTextInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Type your signature name">
                </div>
                <div id="signatureDrawWrap" class="hidden space-y-3">
                    <canvas id="signatureDrawCanvas" width="720" height="220" class="w-full rounded-2xl border border-gray-200 dark:border-gray-700 bg-white touch-none"></canvas>
                    <div class="flex flex-wrap gap-3">
                        <button id="clearSignaturePadBtn" type="button" class="px-4 py-3 rounded-xl bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-100 font-semibold hover:bg-slate-200 dark:hover:bg-slate-700 transition">Clear Drawing</button>
                    </div>
                </div>
            </div>
            <button id="signPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Sign PDF Online Free</button>
        </div>
        <div class="rounded-2xl border border-blue-100 bg-blue-50/70 dark:bg-blue-950/20 dark:border-blue-900 p-4 text-sm text-blue-900 dark:text-blue-100">
            How to sign PDF:
            Upload the PDF, type or draw your signature, place it on the needed page by dragging, and download the signed PDF file.
        </div>
        <div id="signPdfEmpty" class="rounded-2xl border border-dashed border-gray-300 dark:border-gray-700 p-8 text-center text-sm text-gray-500">PDF pages will appear here after upload so you can place your signature visually.</div>
        <div id="signPdfGrid" class="hidden grid sm:grid-cols-2 xl:grid-cols-3 gap-4"></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";

        const signPdfInput = document.getElementById("signPdfInput");
        const signPdfBtn = document.getElementById("signPdfBtn");
        const signPdfStatus = document.getElementById("signPdfStatus");
        const signPdfControls = document.getElementById("signPdfControls");
        const signPdfGrid = document.getElementById("signPdfGrid");
        const signPdfEmpty = document.getElementById("signPdfEmpty");
        const signatureMode = document.getElementById("signatureMode");
        const signatureFontStyle = document.getElementById("signatureFontStyle");
        const signatureTextInput = document.getElementById("signatureTextInput");
        const signatureTextWrap = document.getElementById("signatureTextWrap");
        const signatureDrawWrap = document.getElementById("signatureDrawWrap");
        const signatureDrawCanvas = document.getElementById("signatureDrawCanvas");
        const clearSignaturePadBtn = document.getElementById("clearSignaturePadBtn");
        const signaturePadCtx = signatureDrawCanvas.getContext("2d");

        let signPdfBytes = null;
        let signPdfDoc = null;
        let signPdfViewDoc = null;
        let signPdfPages = [];
        let signatureHasDrawing = false;

        function setSignPdfStatus(message, isError) {
            if (!message) {
                signPdfStatus.textContent = "";
                signPdfStatus.classList.add("hidden");
                signPdfStatus.classList.remove("text-red-500");
                return;
            }

            signPdfStatus.textContent = message;
            signPdfStatus.classList.remove("hidden");
            signPdfStatus.classList.toggle("text-red-500", !!isError);
        }

        function updateSignPdfVisibility() {
            const hasPages = signPdfPages.length > 0;
            signPdfControls.classList.toggle("hidden", !hasPages);
            signPdfGrid.classList.toggle("hidden", !hasPages);
            signPdfEmpty.classList.toggle("hidden", hasPages);
        }

        function getSignPdfBaseName(name) {
            let baseName = name || "signed";
            if (baseName.toLowerCase().slice(-4) === ".pdf") {
                baseName = baseName.slice(0, -4);
            }
            return baseName || "signed";
        }

        function clearSignaturePad() {
            signaturePadCtx.fillStyle = "#ffffff";
            signaturePadCtx.fillRect(0, 0, signatureDrawCanvas.width, signatureDrawCanvas.height);
            signaturePadCtx.lineWidth = 3;
            signaturePadCtx.lineCap = "round";
            signaturePadCtx.lineJoin = "round";
            signaturePadCtx.strokeStyle = "#111827";
            signatureHasDrawing = false;
        }

        clearSignaturePad();

        function getSignatureStyleMeta() {
            const value = signatureFontStyle.value;
            if (value === "classic") {
                return {
                    fontName: PDFLib.StandardFonts.TimesRomanItalic,
                    cssFont: "\"Times New Roman\", serif",
                    cssWeight: "500"
                };
            }
            if (value === "clean") {
                return {
                    fontName: PDFLib.StandardFonts.HelveticaOblique,
                    cssFont: "Arial, sans-serif",
                    cssWeight: "500"
                };
            }
            if (value === "bold") {
                return {
                    fontName: PDFLib.StandardFonts.HelveticaBoldOblique,
                    cssFont: "Arial Black, Arial, sans-serif",
                    cssWeight: "700"
                };
            }
            return {
                fontName: PDFLib.StandardFonts.CourierOblique,
                cssFont: "\"Brush Script MT\", \"Segoe Script\", cursive",
                cssWeight: "500"
            };
        }

        function getCurrentSignatureDataUrl() {
            if (signatureMode.value === "draw") {
                return signatureHasDrawing ? signatureDrawCanvas.toDataURL("image/png") : "";
            }
            return "";
        }

        function createDefaultPlacement() {
            return {
                xRatio: 0.34,
                yRatio: 0.68,
                widthRatio: 0.3
            };
        }

        async function renderSignPdfThumbnail(item, canvas) {
            if (!signPdfViewDoc) return;
            const page = await signPdfViewDoc.getPage(item.pageNumber);
            const viewport = page.getViewport({ scale: 0.34 });
            const context = canvas.getContext("2d");
            canvas.width = Math.ceil(viewport.width);
            canvas.height = Math.ceil(viewport.height);
            context.fillStyle = "#ffffff";
            context.fillRect(0, 0, canvas.width, canvas.height);
            await page.render({
                canvasContext: context,
                viewport: viewport
            }).promise;
        }

        function clamp(value, min, max) {
            return Math.min(max, Math.max(min, value));
        }

        function buildSignatureOverlay(pageItem, stage) {
            const placement = pageItem.placement;
            if (!placement) return null;

            const overlay = document.createElement("div");
            overlay.className = "absolute z-10 cursor-move select-none touch-none";
            overlay.style.left = (placement.xRatio * 100) + "%";
            overlay.style.top = (placement.yRatio * 100) + "%";
            overlay.style.width = (placement.widthRatio * 100) + "%";

            if (signatureMode.value === "draw") {
                const dataUrl = getCurrentSignatureDataUrl();
                if (!dataUrl) return null;
                const image = document.createElement("img");
                image.src = dataUrl;
                image.className = "w-full h-auto block";
                image.draggable = false;
                overlay.appendChild(image);
            } else {
                const text = (signatureTextInput.value || "").trim() || "Signature";
                const styleMeta = getSignatureStyleMeta();
                const textNode = document.createElement("div");
                textNode.className = "w-full text-slate-900 leading-none break-words";
                textNode.style.fontFamily = styleMeta.cssFont;
                textNode.style.fontWeight = styleMeta.cssWeight;
                textNode.style.fontSize = "24px";
                textNode.style.fontStyle = "italic";
                textNode.textContent = text;
                overlay.appendChild(textNode);
            }

            overlay.addEventListener("pointerdown", function(event) {
                event.preventDefault();
                const stageRect = stage.getBoundingClientRect();
                const overlayRect = overlay.getBoundingClientRect();
                const startOffsetX = event.clientX - overlayRect.left;
                const startOffsetY = event.clientY - overlayRect.top;

                function moveAt(moveEvent) {
                    const currentRect = overlay.getBoundingClientRect();
                    const widthRatio = currentRect.width / stageRect.width;
                    const heightRatio = currentRect.height / stageRect.height;
                    const nextLeft = clamp((moveEvent.clientX - stageRect.left - startOffsetX) / stageRect.width, 0, 1 - widthRatio);
                    const nextTop = clamp((moveEvent.clientY - stageRect.top - startOffsetY) / stageRect.height, 0, 1 - heightRatio);

                    pageItem.placement.xRatio = nextLeft;
                    pageItem.placement.yRatio = nextTop;
                    overlay.style.left = (nextLeft * 100) + "%";
                    overlay.style.top = (nextTop * 100) + "%";
                }

                function finishMove() {
                    window.removeEventListener("pointermove", moveAt);
                    window.removeEventListener("pointerup", finishMove);
                }

                window.addEventListener("pointermove", moveAt);
                window.addEventListener("pointerup", finishMove);
            });

            return overlay;
        }

        function createSignPdfCard(pageItem) {
            const card = document.createElement("div");
            card.className = "rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 shadow-sm overflow-hidden";

            const stage = document.createElement("div");
            stage.className = "relative bg-gray-100 dark:bg-gray-800";

            const canvas = document.createElement("canvas");
            canvas.className = "w-full h-auto block bg-white";
            stage.appendChild(canvas);

            const overlay = buildSignatureOverlay(pageItem, stage);
            if (overlay) {
                stage.appendChild(overlay);
            }

            const body = document.createElement("div");
            body.className = "p-4 space-y-3";

            const info = document.createElement("div");
            info.innerHTML = "<div class=\"text-xs uppercase tracking-[0.18em] text-gray-400\">Page " + pageItem.pageNumber + "</div><div class=\"mt-1 text-sm font-semibold text-gray-900 dark:text-gray-100\">Drag signature to position</div>";

            const controls = document.createElement("div");
            controls.className = "flex flex-wrap gap-2";

            const placeBtn = document.createElement("button");
            placeBtn.type = "button";
            placeBtn.className = "px-3 py-2 rounded-lg bg-blue-600 text-white text-xs font-semibold hover:bg-blue-700 transition";
            placeBtn.textContent = pageItem.placement ? "Reset Signature Position" : "Place Signature Here";
            placeBtn.addEventListener("click", function() {
                pageItem.placement = createDefaultPlacement();
                renderSignPdfGrid();
            });

            const removeBtn = document.createElement("button");
            removeBtn.type = "button";
            removeBtn.className = "px-3 py-2 rounded-lg bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-100 text-xs font-semibold";
            removeBtn.textContent = "Remove Signature";
            removeBtn.disabled = !pageItem.placement;
            removeBtn.addEventListener("click", function() {
                pageItem.placement = null;
                renderSignPdfGrid();
            });

            controls.appendChild(placeBtn);
            controls.appendChild(removeBtn);
            body.appendChild(info);
            body.appendChild(controls);
            card.appendChild(stage);
            card.appendChild(body);

            renderSignPdfThumbnail(pageItem, canvas);
            return card;
        }

        function renderSignPdfGrid() {
            signPdfGrid.innerHTML = "";
            updateSignPdfVisibility();
            signPdfPages.forEach(function(pageItem) {
                signPdfGrid.appendChild(createSignPdfCard(pageItem));
            });
        }

        function refreshSignaturePreview() {
            if (!signPdfPages.length) return;
            renderSignPdfGrid();
        }

        signatureMode.addEventListener("change", function() {
            const drawMode = signatureMode.value === "draw";
            signatureTextWrap.classList.toggle("hidden", drawMode);
            signatureDrawWrap.classList.toggle("hidden", !drawMode);
            refreshSignaturePreview();
        });

        signatureFontStyle.addEventListener("change", refreshSignaturePreview);
        signatureTextInput.addEventListener("input", refreshSignaturePreview);
        clearSignaturePadBtn.addEventListener("click", function() {
            clearSignaturePad();
            refreshSignaturePreview();
        });

        signatureDrawCanvas.addEventListener("pointerdown", function(event) {
            signatureHasDrawing = true;
            signatureDrawCanvas.setPointerCapture(event.pointerId);
            const rect = signatureDrawCanvas.getBoundingClientRect();
            signaturePadCtx.beginPath();
            signaturePadCtx.moveTo(
                (event.clientX - rect.left) * (signatureDrawCanvas.width / rect.width),
                (event.clientY - rect.top) * (signatureDrawCanvas.height / rect.height)
            );

            function draw(moveEvent) {
                const moveRect = signatureDrawCanvas.getBoundingClientRect();
                signaturePadCtx.lineTo(
                    (moveEvent.clientX - moveRect.left) * (signatureDrawCanvas.width / moveRect.width),
                    (moveEvent.clientY - moveRect.top) * (signatureDrawCanvas.height / moveRect.height)
                );
                signaturePadCtx.stroke();
            }

            function stopDrawing() {
                signatureDrawCanvas.removeEventListener("pointermove", draw);
                signatureDrawCanvas.removeEventListener("pointerup", stopDrawing);
                signatureDrawCanvas.removeEventListener("pointerleave", stopDrawing);
                refreshSignaturePreview();
            }

            signatureDrawCanvas.addEventListener("pointermove", draw);
            signatureDrawCanvas.addEventListener("pointerup", stopDrawing);
            signatureDrawCanvas.addEventListener("pointerleave", stopDrawing);
        });

        signPdfInput.addEventListener("change", async function() {
            const file = this.files && this.files[0] ? this.files[0] : null;
            signPdfPages = [];
            signPdfBytes = null;
            signPdfDoc = null;
            signPdfViewDoc = null;
            renderSignPdfGrid();

            if (!file) {
                setSignPdfStatus("");
                return;
            }

            try {
                setSignPdfStatus("Loading PDF pages...");
                signPdfBytes = await file.arrayBuffer();
                signPdfDoc = await PDFLib.PDFDocument.load(signPdfBytes);
                signPdfViewDoc = await pdfjsLib.getDocument({ data: signPdfBytes }).promise;
                for (let i = 1; i <= signPdfDoc.getPageCount(); i++) {
                    signPdfPages.push({
                        pageNumber: i,
                        placement: null
                    });
                }
                renderSignPdfGrid();
                setSignPdfStatus("Choose a signature type, place it on any page, and download the signed PDF.");
            } catch (error) {
                setSignPdfStatus("Could not load this PDF: " + error.message, true);
            }
        });

        signPdfBtn.addEventListener("click", async function() {
            const pdfFile = signPdfInput.files && signPdfInput.files[0] ? signPdfInput.files[0] : null;
            if (!pdfFile) {
                alert("Please select a PDF file");
                return;
            }

            const placedPages = signPdfPages.filter(function(pageItem) {
                return !!pageItem.placement;
            });
            if (!placedPages.length) {
                alert("Please place the signature on at least one page.");
                return;
            }

            if (signatureMode.value === "text" && !(signatureTextInput.value || "").trim()) {
                alert("Please type a signature.");
                return;
            }

            if (signatureMode.value === "draw" && !signatureHasDrawing) {
                alert("Please draw a signature first.");
                return;
            }

            try {
                setSignPdfStatus("Applying signature to PDF...");
                const pdf = await PDFLib.PDFDocument.load(signPdfBytes);
                const pages = pdf.getPages();

                if (signatureMode.value === "draw") {
                    const imageBytes = await fetch(getCurrentSignatureDataUrl()).then(function(response) {
                        return response.arrayBuffer();
                    });
                    const signatureImage = await pdf.embedPng(imageBytes);
                    const aspectRatio = signatureImage.height / signatureImage.width;

                    placedPages.forEach(function(pageItem) {
                        const page = pages[pageItem.pageNumber - 1];
                        const pageWidth = page.getWidth();
                        const pageHeight = page.getHeight();
                        const width = pageWidth * pageItem.placement.widthRatio;
                        const height = width * aspectRatio;
                        const x = pageWidth * pageItem.placement.xRatio;
                        const y = pageHeight - (pageHeight * pageItem.placement.yRatio) - height;
                        page.drawImage(signatureImage, {
                            x: x,
                            y: y,
                            width: width,
                            height: height
                        });
                    });
                } else {
                    const styleMeta = getSignatureStyleMeta();
                    const font = await pdf.embedFont(styleMeta.fontName);
                    const signatureText = (signatureTextInput.value || "").trim();

                    placedPages.forEach(function(pageItem) {
                        const page = pages[pageItem.pageNumber - 1];
                        const pageWidth = page.getWidth();
                        const pageHeight = page.getHeight();
                        const targetWidth = pageWidth * pageItem.placement.widthRatio;
                        let fontSize = Math.max(18, pageWidth * 0.055);
                        while (font.widthOfTextAtSize(signatureText, fontSize) > targetWidth && fontSize > 8) {
                            fontSize -= 1;
                        }

                        const textWidth = font.widthOfTextAtSize(signatureText, fontSize);
                        const textHeight = fontSize * 1.15;
                        const x = pageWidth * pageItem.placement.xRatio;
                        const y = pageHeight - (pageHeight * pageItem.placement.yRatio) - textHeight;

                        page.drawText(signatureText, {
                            x: x,
                            y: y,
                            size: fontSize,
                            font: font,
                            color: PDFLib.rgb(0.1, 0.1, 0.1)
                        });
                    });
                }

                const bytes = await pdf.save();
                const a = document.createElement("a");
                a.href = URL.createObjectURL(new Blob([bytes], { type: "application/pdf" }));
                a.download = getSignPdfBaseName(pdfFile.name) + "_signed.pdf";
                a.click();
                setSignPdfStatus("Signed PDF downloaded successfully.");
            } catch (error) {
                setSignPdfStatus("Could not sign this PDF: " + error.message, true);
            }
        });
    </script>';
}

function getCropPdfHTML() {
    return '
    <div class="space-y-6">
        <div style="display:none;">
            <h1>Crop PDF Online Free - Crop PDF Pages</h1>
            <p>Use this crop PDF tool to crop PDF online free, choose the crop area visually, and save cropped PDF pages directly in your browser.</p>
            <p>Learn how to crop PDF files, crop PDF pages online, and trim PDF page edges on Mac, Windows, and mobile with a visual crop box editor.</p>
        </div>
        <div class="rounded-2xl border border-gray-200 dark:border-gray-700 p-5 space-y-4 bg-white dark:bg-gray-900">
            <div>
                <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">Crop PDF Pages</div>
                <p class="text-sm text-gray-500 mt-1">Upload a PDF, drag the crop box to the exact area you want to keep, resize it, and download the cropped PDF.</p>
            </div>
            <input type="file" id="cropPdfInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
            <div id="cropPdfStatus" class="hidden text-sm text-gray-500 text-center"></div>
            <div id="cropPdfToolbar" class="hidden flex flex-wrap gap-3">
                <button id="cropPdfApplyAllBtn" type="button" class="px-4 py-3 rounded-xl bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-100 font-semibold hover:bg-slate-200 dark:hover:bg-slate-700 transition">Apply First Crop To All Pages</button>
                <button id="cropPdfResetBtn" type="button" class="px-4 py-3 rounded-xl bg-amber-100 text-amber-900 dark:bg-amber-900/30 dark:text-amber-200 font-semibold hover:bg-amber-200 dark:hover:bg-amber-900/50 transition">Reset Crop Boxes</button>
                <button id="cropPdfBtn" type="button" class="px-4 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">Crop PDF Free</button>
            </div>
        </div>
        <div class="rounded-2xl border border-blue-100 bg-blue-50/70 dark:bg-blue-950/20 dark:border-blue-900 p-4 text-sm text-blue-900 dark:text-blue-100">
            How to crop PDF:
            Upload the file, move and resize the crop area on the page preview, then save the cropped PDF file.
        </div>
        <div id="cropPdfEmpty" class="rounded-2xl border border-dashed border-gray-300 dark:border-gray-700 p-8 text-center text-sm text-gray-500">PDF page previews will appear here after upload so you can crop PDF pages visually.</div>
        <div id="cropPdfGrid" class="hidden grid sm:grid-cols-2 xl:grid-cols-3 gap-4"></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";

        const cropPdfInput = document.getElementById("cropPdfInput");
        const cropPdfStatus = document.getElementById("cropPdfStatus");
        const cropPdfToolbar = document.getElementById("cropPdfToolbar");
        const cropPdfGrid = document.getElementById("cropPdfGrid");
        const cropPdfEmpty = document.getElementById("cropPdfEmpty");
        const cropPdfApplyAllBtn = document.getElementById("cropPdfApplyAllBtn");
        const cropPdfResetBtn = document.getElementById("cropPdfResetBtn");
        const cropPdfBtn = document.getElementById("cropPdfBtn");

        let cropPdfBytes = null;
        let cropPdfDoc = null;
        let cropPdfViewDoc = null;
        let cropPdfItems = [];

        function setCropPdfStatus(message, isError) {
            if (!message) {
                cropPdfStatus.textContent = "";
                cropPdfStatus.classList.add("hidden");
                cropPdfStatus.classList.remove("text-red-500");
                return;
            }

            cropPdfStatus.textContent = message;
            cropPdfStatus.classList.remove("hidden");
            cropPdfStatus.classList.toggle("text-red-500", !!isError);
        }

        function updateCropPdfVisibility() {
            const hasItems = cropPdfItems.length > 0;
            cropPdfGrid.classList.toggle("hidden", !hasItems);
            cropPdfToolbar.classList.toggle("hidden", !hasItems);
            cropPdfEmpty.classList.toggle("hidden", hasItems);
        }

        function createDefaultCropArea() {
            return {
                xRatio: 0.08,
                yRatio: 0.08,
                widthRatio: 0.84,
                heightRatio: 0.84
            };
        }

        function getCropPdfBaseName(name) {
            let baseName = name || "cropped";
            if (baseName.toLowerCase().slice(-4) === ".pdf") {
                baseName = baseName.slice(0, -4);
            }
            return baseName || "cropped";
        }

        function clamp(value, min, max) {
            return Math.min(max, Math.max(min, value));
        }

        async function renderCropThumbnail(item, canvas) {
            if (!cropPdfViewDoc) return;
            const page = await cropPdfViewDoc.getPage(item.pageNumber);
            const viewport = page.getViewport({ scale: 0.34 });
            const context = canvas.getContext("2d");
            canvas.width = Math.ceil(viewport.width);
            canvas.height = Math.ceil(viewport.height);
            context.fillStyle = "#ffffff";
            context.fillRect(0, 0, canvas.width, canvas.height);
            await page.render({
                canvasContext: context,
                viewport: viewport
            }).promise;
        }

        function makeCropOverlay(item, stage) {
            const cropArea = item.cropArea;
            const box = document.createElement("div");
            box.className = "absolute border-2 border-blue-500 bg-blue-500/10 cursor-move z-10";
            box.style.left = (cropArea.xRatio * 100) + "%";
            box.style.top = (cropArea.yRatio * 100) + "%";
            box.style.width = (cropArea.widthRatio * 100) + "%";
            box.style.height = (cropArea.heightRatio * 100) + "%";

            const label = document.createElement("div");
            label.className = "absolute -top-7 left-0 px-2 py-1 rounded-md bg-blue-600 text-white text-[11px] font-semibold whitespace-nowrap";
            label.textContent = "Crop Area";
            box.appendChild(label);

            const handle = document.createElement("div");
            handle.className = "absolute -right-2 -bottom-2 w-5 h-5 rounded-full bg-blue-600 border-2 border-white cursor-se-resize";
            box.appendChild(handle);

            box.addEventListener("pointerdown", function(event) {
                if (event.target === handle) return;
                event.preventDefault();

                const stageRect = stage.getBoundingClientRect();
                const boxRect = box.getBoundingClientRect();
                const offsetX = event.clientX - boxRect.left;
                const offsetY = event.clientY - boxRect.top;

                function move(moveEvent) {
                    const widthRatio = boxRect.width / stageRect.width;
                    const heightRatio = boxRect.height / stageRect.height;
                    const xRatio = clamp((moveEvent.clientX - stageRect.left - offsetX) / stageRect.width, 0, 1 - widthRatio);
                    const yRatio = clamp((moveEvent.clientY - stageRect.top - offsetY) / stageRect.height, 0, 1 - heightRatio);
                    item.cropArea.xRatio = xRatio;
                    item.cropArea.yRatio = yRatio;
                    box.style.left = (xRatio * 100) + "%";
                    box.style.top = (yRatio * 100) + "%";
                }

                function stop() {
                    window.removeEventListener("pointermove", move);
                    window.removeEventListener("pointerup", stop);
                }

                window.addEventListener("pointermove", move);
                window.addEventListener("pointerup", stop);
            });

            handle.addEventListener("pointerdown", function(event) {
                event.preventDefault();
                event.stopPropagation();

                const stageRect = stage.getBoundingClientRect();

                function resize(moveEvent) {
                    const nextWidth = clamp((moveEvent.clientX - stageRect.left) / stageRect.width - item.cropArea.xRatio, 0.12, 1 - item.cropArea.xRatio);
                    const nextHeight = clamp((moveEvent.clientY - stageRect.top) / stageRect.height - item.cropArea.yRatio, 0.12, 1 - item.cropArea.yRatio);
                    item.cropArea.widthRatio = nextWidth;
                    item.cropArea.heightRatio = nextHeight;
                    box.style.width = (nextWidth * 100) + "%";
                    box.style.height = (nextHeight * 100) + "%";
                }

                function stopResize() {
                    window.removeEventListener("pointermove", resize);
                    window.removeEventListener("pointerup", stopResize);
                }

                window.addEventListener("pointermove", resize);
                window.addEventListener("pointerup", stopResize);
            });

            return box;
        }

        function createCropCard(item) {
            const card = document.createElement("div");
            card.className = "rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 shadow-sm overflow-hidden";

            const stage = document.createElement("div");
            stage.className = "relative bg-gray-100 dark:bg-gray-800";

            const canvas = document.createElement("canvas");
            canvas.className = "w-full h-auto block bg-white";
            stage.appendChild(canvas);
            stage.appendChild(makeCropOverlay(item, stage));

            const body = document.createElement("div");
            body.className = "p-4 space-y-3";

            const info = document.createElement("div");
            info.innerHTML = "<div class=\"text-xs uppercase tracking-[0.18em] text-gray-400\">Page " + item.pageNumber + "</div><div class=\"mt-1 text-sm font-semibold text-gray-900 dark:text-gray-100\">Drag and resize the crop box</div>";

            const resetBtn = document.createElement("button");
            resetBtn.type = "button";
            resetBtn.className = "px-3 py-2 rounded-lg bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-100 text-xs font-semibold";
            resetBtn.textContent = "Reset This Page";
            resetBtn.addEventListener("click", function() {
                item.cropArea = createDefaultCropArea();
                renderCropPdfGrid();
            });

            body.appendChild(info);
            body.appendChild(resetBtn);
            card.appendChild(stage);
            card.appendChild(body);

            renderCropThumbnail(item, canvas);
            return card;
        }

        function renderCropPdfGrid() {
            cropPdfGrid.innerHTML = "";
            updateCropPdfVisibility();
            cropPdfItems.forEach(function(item) {
                cropPdfGrid.appendChild(createCropCard(item));
            });
        }

        cropPdfInput.addEventListener("change", async function() {
            const file = this.files && this.files[0] ? this.files[0] : null;
            cropPdfItems = [];
            cropPdfBytes = null;
            cropPdfDoc = null;
            cropPdfViewDoc = null;
            renderCropPdfGrid();

            if (!file) {
                setCropPdfStatus("");
                return;
            }

            try {
                setCropPdfStatus("Loading PDF pages...");
                cropPdfBytes = await file.arrayBuffer();
                cropPdfDoc = await PDFLib.PDFDocument.load(cropPdfBytes);
                cropPdfViewDoc = await pdfjsLib.getDocument({ data: cropPdfBytes }).promise;

                for (let i = 1; i <= cropPdfDoc.getPageCount(); i++) {
                    cropPdfItems.push({
                        pageNumber: i,
                        cropArea: createDefaultCropArea()
                    });
                }

                renderCropPdfGrid();
                setCropPdfStatus("Move the crop box on each page, or apply the first crop to all pages.");
            } catch (error) {
                setCropPdfStatus("Could not load this PDF: " + error.message, true);
            }
        });

        cropPdfApplyAllBtn.addEventListener("click", function() {
            if (!cropPdfItems.length) return;
            const first = cropPdfItems[0].cropArea;
            cropPdfItems.forEach(function(item) {
                item.cropArea = {
                    xRatio: first.xRatio,
                    yRatio: first.yRatio,
                    widthRatio: first.widthRatio,
                    heightRatio: first.heightRatio
                };
            });
            renderCropPdfGrid();
        });

        cropPdfResetBtn.addEventListener("click", function() {
            cropPdfItems.forEach(function(item) {
                item.cropArea = createDefaultCropArea();
            });
            renderCropPdfGrid();
        });

        cropPdfBtn.addEventListener("click", async function() {
            const file = cropPdfInput.files && cropPdfInput.files[0] ? cropPdfInput.files[0] : null;
            if (!file) {
                alert("Please select a PDF file");
                return;
            }

            try {
                setCropPdfStatus("Applying crop boxes to PDF...");
                const pdf = await PDFLib.PDFDocument.load(cropPdfBytes);
                const pages = pdf.getPages();

                cropPdfItems.forEach(function(item, index) {
                    const page = pages[index];
                    const width = page.getWidth();
                    const height = page.getHeight();
                    const x = width * item.cropArea.xRatio;
                    const cropWidth = Math.max(20, width * item.cropArea.widthRatio);
                    const cropHeight = Math.max(20, height * item.cropArea.heightRatio);
                    const yTop = height * item.cropArea.yRatio;
                    const y = Math.max(0, height - yTop - cropHeight);

                    page.setCropBox(x, y, Math.min(cropWidth, width - x), Math.min(cropHeight, height - y));
                });

                const bytes = await pdf.save();
                const a = document.createElement("a");
                a.href = URL.createObjectURL(new Blob([bytes], { type: "application/pdf" }));
                a.download = getCropPdfBaseName(file.name) + "_cropped.pdf";
                a.click();
                setCropPdfStatus("Crop complete. Cropped PDF downloaded.");
            } catch (error) {
                setCropPdfStatus("Could not crop this PDF: " + error.message, true);
            }
        });
    </script>';
}

function getComparePdfHTML() {
    return '
    <div class="space-y-6">
        <div style="display:none;">
            <h1>Compare PDF Online Free - Compare PDF Files Side by Side</h1>
            <p>Use this compare PDF tool to compare PDF files online, review PDF documents side by side, and find text differences between uploaded PDF files.</p>
            <p>Learn how to compare PDF documents, compare PDF files for differences, and compare PDF side by side directly in your browser.</p>
        </div>
        <div class="rounded-2xl border border-gray-200 dark:border-gray-700 p-5 space-y-4 bg-white dark:bg-gray-900">
            <div>
                <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">Compare PDF Documents</div>
                <p class="text-sm text-gray-500 mt-1">Upload two PDF files, preview them side by side, and compare the extracted text for differences.</p>
            </div>
            <div class="grid md:grid-cols-2 gap-4">
                <input type="file" id="comparePdfInputA" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
                <input type="file" id="comparePdfInputB" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
            </div>
            <button id="comparePdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Compare PDF Files</button>
        </div>
        <div class="rounded-2xl border border-blue-100 bg-blue-50/70 dark:bg-blue-950/20 dark:border-blue-900 p-4 text-sm text-blue-900 dark:text-blue-100">
            How to compare PDF files:
            Upload both PDF documents, review the preview side by side, and run the comparison to find differences in the extracted content.
        </div>
        <div class="grid lg:grid-cols-2 gap-4">
            <div class="rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 overflow-hidden">
                <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 text-sm font-semibold text-gray-900 dark:text-gray-100">PDF A Preview</div>
                <div id="comparePdfPreviewA" class="aspect-[3/4] bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-sm text-gray-500 p-4">Upload the first PDF to preview it here.</div>
            </div>
            <div class="rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 overflow-hidden">
                <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 text-sm font-semibold text-gray-900 dark:text-gray-100">PDF B Preview</div>
                <div id="comparePdfPreviewB" class="aspect-[3/4] bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-sm text-gray-500 p-4">Upload the second PDF to preview it here.</div>
            </div>
        </div>
        <div id="comparePdfResult" class="hidden p-5 rounded-2xl bg-slate-50 border border-slate-200 dark:bg-slate-900 dark:border-slate-700 space-y-3">
            <div id="comparePdfSummary" class="text-sm text-slate-700 dark:text-slate-200"></div>
            <textarea id="comparePdfDiff" class="w-full h-72 p-4 rounded-xl border border-slate-200 bg-white text-slate-900 dark:bg-slate-800 dark:text-slate-100 dark:border-slate-600"></textarea>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";
        const comparePdfInputA = document.getElementById("comparePdfInputA");
        const comparePdfInputB = document.getElementById("comparePdfInputB");
        const comparePdfPreviewA = document.getElementById("comparePdfPreviewA");
        const comparePdfPreviewB = document.getElementById("comparePdfPreviewB");

        async function renderComparePreview(file, container, emptyText) {
            container.innerHTML = "";

            if (!file) {
                container.textContent = emptyText;
                return;
            }

            try {
                const pdf = await pdfjsLib.getDocument({ data: await file.arrayBuffer() }).promise;
                const page = await pdf.getPage(1);
                const viewport = page.getViewport({ scale: 0.45 });
                const canvas = document.createElement("canvas");
                const context = canvas.getContext("2d", { alpha: false });
                canvas.width = Math.ceil(viewport.width);
                canvas.height = Math.ceil(viewport.height);
                canvas.className = "w-full h-full object-contain bg-white";
                context.fillStyle = "#FFFFFF";
                context.fillRect(0, 0, canvas.width, canvas.height);
                await page.render({
                    canvasContext: context,
                    viewport: viewport
                }).promise;
                container.appendChild(canvas);
            } catch (error) {
                container.textContent = "Could not preview this PDF: " + error.message;
            }
        }

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

        comparePdfInputA.addEventListener("change", function() {
            renderComparePreview(this.files[0], comparePdfPreviewA, "Upload the first PDF to preview it here.");
        });

        comparePdfInputB.addEventListener("change", function() {
            renderComparePreview(this.files[0], comparePdfPreviewB, "Upload the second PDF to preview it here.");
        });

        document.getElementById("comparePdfBtn").addEventListener("click", async function() {
            const fileA = comparePdfInputA.files[0];
            const fileB = comparePdfInputB.files[0];
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
        <div style="display:none;">
            <h1>Convert PDF to PDF/A Online Free</h1>
            <p>Use this PDF to PDF/A tool to create a PDF/A style export online, improve long-term document compatibility, and rebuild PDF files for archival-focused use.</p>
            <p>Convert PDF to PDF/A free in your browser, create an archival PDF export, and generate a cleaner PDF/A-style document for storage and sharing.</p>
        </div>
        <div class="rounded-2xl border border-blue-200/70 bg-blue-50/80 dark:bg-blue-950/30 dark:border-blue-900 p-4">
            <div class="font-semibold text-blue-900 dark:text-blue-100">PDF to PDF/A-style Export</div>
            <p class="mt-1 text-sm text-blue-800 dark:text-blue-200">Convert PDF to PDF/A-style output with cleaner archival metadata for compatibility-focused storage. This is a best-effort PDF/A-style export, not formal PDF/A certification.</p>
        </div>
        <input type="file" id="pdfaInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
        <input type="text" id="pdfaTitle" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Optional document title">
        <div class="rounded-2xl border border-blue-100 bg-blue-50/70 dark:bg-blue-950/20 dark:border-blue-900 p-4 text-sm text-blue-900 dark:text-blue-100">
            How to convert PDF to PDF/A:
            Upload the PDF file, optionally set a document title, and create a PDF/A-style export for archival-focused use.
        </div>
        <button id="pdfaBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Convert PDF to PDF/A-style Export</button>
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
        <div style="display:none;">
            <h1>Edit PDF Online Free</h1>
            <p>Use this edit PDF tool to edit PDF online free, insert text or images on PDF pages, and download the updated PDF file in your browser.</p>
            <p>Edit PDF text, add pictures, edit PDF free online, and use a visual PDF editor workspace on Mac, Windows, and mobile browsers.</p>
        </div>
        <div class="rounded-2xl border border-indigo-200/70 bg-indigo-50/80 dark:bg-indigo-950/30 dark:border-indigo-900 p-4">
            <div class="font-semibold text-indigo-900 dark:text-indigo-100">Simple PDF editor</div>
            <p class="mt-1 text-sm text-indigo-800 dark:text-indigo-200">Upload a PDF, view one large page preview, add text or an image, then download the edited PDF.</p>
        </div>
        <div class="rounded-2xl border border-gray-200 dark:border-gray-700 p-5 space-y-4 bg-white dark:bg-gray-900">
            <input type="file" id="editPdfInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
            <div id="editPdfStatus" class="hidden text-sm text-gray-500 text-center"></div>
            <div id="editPdfControls" class="hidden space-y-4">
                <div class="grid md:grid-cols-2 gap-4">
                    <select id="editPdfPageSelect" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600"></select>
                    <button id="refreshEditPdfPreviewBtn" type="button" class="w-full bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-100 py-3 rounded-xl font-semibold hover:bg-slate-200 dark:hover:bg-slate-700 transition">Refresh Preview</button>
                </div>
                <div class="rounded-3xl border border-gray-200 dark:border-gray-700 bg-slate-50 dark:bg-slate-950/40 p-4">
                    <div id="editPdfPageInfo" class="text-sm text-gray-500 mb-3">Upload a PDF to start editing.</div>
                    <div id="editPdfStageWrap" class="hidden overflow-auto rounded-2xl border border-gray-200 dark:border-gray-700 bg-slate-100 dark:bg-slate-900 p-3">
                        <div class="min-w-max mx-auto">
                            <div id="editPdfStage" class="relative bg-white shadow-lg overflow-visible"></div>
                        </div>
                    </div>
                    <div id="editPdfEmpty" class="rounded-2xl border border-dashed border-gray-300 dark:border-gray-700 p-10 text-center text-sm text-gray-500">A large PDF preview will appear here after upload.</div>
                </div>
                <div class="rounded-2xl border border-gray-200 dark:border-gray-700 p-4 space-y-4">
                    <div class="font-semibold text-gray-900 dark:text-gray-100">Text Inserter</div>
                    <textarea id="editPdfText" class="w-full h-24 p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Enter text to insert"></textarea>
                    <div class="grid md:grid-cols-3 gap-3">
                        <input type="number" id="editPdfTextSize" min="8" value="22" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Text size">
                        <select id="editPdfTextStyle" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600">
                            <option value="regular">Regular</option>
                            <option value="bold">Bold</option>
                            <option value="italic">Italic</option>
                        </select>
                        <button id="addEditPdfTextBtn" type="button" class="w-full bg-indigo-600 text-white py-3 rounded-xl font-semibold hover:bg-indigo-700 transition">Add Text</button>
                    </div>
                </div>
                <div class="rounded-2xl border border-gray-200 dark:border-gray-700 p-4 space-y-4">
                    <div class="font-semibold text-gray-900 dark:text-gray-100">Picture Inserter</div>
                    <input type="file" id="editPdfImage" class="w-full p-3 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept="image/*">
                    <div class="grid md:grid-cols-2 gap-3">
                        <button id="addEditPdfImageBtn" type="button" class="w-full bg-slate-800 text-white py-3 rounded-xl font-semibold hover:bg-slate-900 transition">Add Picture</button>
                        <button id="removeEditPdfOverlayBtn" type="button" class="w-full bg-rose-600 text-white py-3 rounded-xl font-semibold hover:bg-rose-700 transition">Remove Selected Item</button>
                    </div>
                </div>
                <div class="rounded-2xl border border-blue-100 bg-blue-50/70 dark:bg-blue-950/20 dark:border-blue-900 p-4 text-sm text-blue-900 dark:text-blue-100">
                    How to edit PDF:
                    Upload the file, choose a page, add text or picture, drag the item on the large preview, and download the edited PDF.
                </div>
                <button id="editPdfBtn" type="button" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Download Edited PDF</button>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";

        const editPdfInput = document.getElementById("editPdfInput");
        const editPdfStatus = document.getElementById("editPdfStatus");
        const editPdfControls = document.getElementById("editPdfControls");
        const editPdfPageSelect = document.getElementById("editPdfPageSelect");
        const refreshEditPdfPreviewBtn = document.getElementById("refreshEditPdfPreviewBtn");
        const editPdfPageInfo = document.getElementById("editPdfPageInfo");
        const editPdfStageWrap = document.getElementById("editPdfStageWrap");
        const editPdfStage = document.getElementById("editPdfStage");
        const editPdfEmpty = document.getElementById("editPdfEmpty");
        const editPdfText = document.getElementById("editPdfText");
        const editPdfTextSize = document.getElementById("editPdfTextSize");
        const editPdfTextStyle = document.getElementById("editPdfTextStyle");
        const addEditPdfTextBtn = document.getElementById("addEditPdfTextBtn");
        const editPdfImage = document.getElementById("editPdfImage");
        const addEditPdfImageBtn = document.getElementById("addEditPdfImageBtn");
        const removeEditPdfOverlayBtn = document.getElementById("removeEditPdfOverlayBtn");
        const downloadEditPdfBtn = document.getElementById("editPdfBtn");

        let editPdfBytes = null;
        let editPdfDoc = null;
        let editPdfViewDoc = null;
        let editPdfPages = [];
        let editPdfCurrentPage = 0;
        let editPdfSelectedOverlayId = null;

        function setEditPdfStatus(message, isError) {
            if (!message) {
                editPdfStatus.textContent = "";
                editPdfStatus.classList.add("hidden");
                editPdfStatus.classList.remove("text-red-500");
                return;
            }

            editPdfStatus.textContent = message;
            editPdfStatus.classList.remove("hidden");
            editPdfStatus.classList.toggle("text-red-500", !!isError);
        }

        function updateEditPdfVisibility() {
            const hasPages = editPdfPages.length > 0;
            editPdfControls.classList.toggle("hidden", !hasPages);
            editPdfStageWrap.classList.toggle("hidden", !hasPages);
            editPdfEmpty.classList.toggle("hidden", hasPages);
        }

        function getEditPdfBaseName(name) {
            let baseName = name || "edited";
            if (baseName.toLowerCase().slice(-4) === ".pdf") {
                baseName = baseName.slice(0, -4);
            }
            return baseName || "edited";
        }

        function clamp(value, min, max) {
            return Math.min(max, Math.max(min, value));
        }

        function rebuildEditPdfPageSelect() {
            editPdfPageSelect.innerHTML = "";
            for (let i = 0; i < editPdfPages.length; i++) {
                const option = document.createElement("option");
                option.value = String(i);
                option.textContent = "Page " + (i + 1);
                editPdfPageSelect.appendChild(option);
            }
            editPdfPageSelect.value = String(editPdfCurrentPage);
        }

        function getCurrentPageData() {
            return editPdfPages[editPdfCurrentPage];
        }

        function getTextCss(style) {
            if (style === "bold") {
                return { fontWeight: "700", fontStyle: "normal" };
            }
            if (style === "italic") {
                return { fontWeight: "500", fontStyle: "italic" };
            }
            return { fontWeight: "500", fontStyle: "normal" };
        }

        function buildOverlayNode(pageData, overlay, stageSize) {
            const node = document.createElement("div");
            node.className = "absolute z-10 cursor-move select-none";
            if (overlay.id === editPdfSelectedOverlayId) {
                node.classList.add("ring-2", "ring-blue-500");
            }

            node.style.left = (overlay.xRatio * stageSize.width) + "px";
            node.style.top = (overlay.yRatio * stageSize.height) + "px";
            node.style.width = (overlay.widthRatio * stageSize.width) + "px";

            if (overlay.type === "text") {
                const textCss = getTextCss(overlay.style);
                node.className += " px-2 py-1 bg-white/80 rounded-md";
                node.style.fontSize = Math.max(10, overlay.sizeRatio * stageSize.width) + "px";
                node.style.fontWeight = textCss.fontWeight;
                node.style.fontStyle = textCss.fontStyle;
                node.style.color = "#111827";
                node.textContent = overlay.text;
            } else {
                const image = document.createElement("img");
                image.src = overlay.src;
                image.className = "w-full h-auto block";
                image.draggable = false;
                node.appendChild(image);
            }

            node.addEventListener("click", function(event) {
                event.stopPropagation();
                editPdfSelectedOverlayId = overlay.id;
                renderEditPdfWorkspace();
            });

            node.addEventListener("pointerdown", function(event) {
                event.preventDefault();
                event.stopPropagation();
                editPdfSelectedOverlayId = overlay.id;

                const stageRect = editPdfStage.getBoundingClientRect();
                const nodeRect = node.getBoundingClientRect();
                const offsetX = event.clientX - nodeRect.left;
                const offsetY = event.clientY - nodeRect.top;

                function move(moveEvent) {
                    const widthRatio = nodeRect.width / stageRect.width;
                    const heightRatio = nodeRect.height / stageRect.height;
                    overlay.xRatio = clamp((moveEvent.clientX - stageRect.left - offsetX) / stageRect.width, 0, 1 - widthRatio);
                    overlay.yRatio = clamp((moveEvent.clientY - stageRect.top - offsetY) / stageRect.height, 0, 1 - heightRatio);
                    node.style.left = (overlay.xRatio * stageSize.width) + "px";
                    node.style.top = (overlay.yRatio * stageSize.height) + "px";
                }

                function stop() {
                    window.removeEventListener("pointermove", move);
                    window.removeEventListener("pointerup", stop);
                    renderEditPdfWorkspace();
                }

                window.addEventListener("pointermove", move);
                window.addEventListener("pointerup", stop);
            });

            return node;
        }

        async function renderEditPdfWorkspace() {
            const pageData = getCurrentPageData();
            if (!pageData) return;

            editPdfPageInfo.textContent = "Editing page " + (editPdfCurrentPage + 1) + " of " + editPdfPages.length;
            editPdfStage.innerHTML = "";

            const page = await editPdfViewDoc.getPage(editPdfCurrentPage + 1);
            const baseViewport = page.getViewport({ scale: 1 });
            const availableWidth = Math.max(500, editPdfStageWrap.clientWidth - 32);
            const availableHeight = Math.max(700, Math.min(window.innerHeight * 0.78, 1100));
            const fitScale = Math.min(1.5, availableWidth / baseViewport.width, availableHeight / baseViewport.height);
            const viewport = page.getViewport({ scale: Math.max(0.65, fitScale) });
            const canvas = document.createElement("canvas");
            const context = canvas.getContext("2d", { alpha: false });
            canvas.width = Math.ceil(viewport.width);
            canvas.height = Math.ceil(viewport.height);
            canvas.className = "block bg-white";
            context.fillStyle = "#ffffff";
            context.fillRect(0, 0, canvas.width, canvas.height);

            editPdfStage.style.width = canvas.width + "px";
            editPdfStage.style.height = canvas.height + "px";
            editPdfStage.style.maxWidth = "none";
            editPdfStage.appendChild(canvas);

            await page.render({
                canvasContext: context,
                viewport: viewport
            }).promise;

            const stageSize = { width: canvas.width, height: canvas.height };
            pageData.overlays.forEach(function(overlay) {
                editPdfStage.appendChild(buildOverlayNode(pageData, overlay, stageSize));
            });

            editPdfStage.onclick = function() {
                editPdfSelectedOverlayId = null;
                renderEditPdfWorkspace();
            };
        }

        function createOverlayId() {
            return "overlay-" + Date.now() + "-" + Math.random().toString(16).slice(2);
        }

        addEditPdfTextBtn.addEventListener("click", function() {
            const pageData = getCurrentPageData();
            const text = (editPdfText.value || "").trim();
            if (!pageData || !text) {
                alert("Please enter text first.");
                return;
            }

            const size = Math.max(8, parseInt(editPdfTextSize.value || "22", 10));
            pageData.overlays.push({
                id: createOverlayId(),
                type: "text",
                text: text,
                style: editPdfTextStyle.value,
                xRatio: 0.14,
                yRatio: 0.16,
                widthRatio: 0.34,
                sizeRatio: size / 700
            });
            renderEditPdfWorkspace();
        });

        addEditPdfImageBtn.addEventListener("click", async function() {
            const pageData = getCurrentPageData();
            const imageFile = editPdfImage.files && editPdfImage.files[0] ? editPdfImage.files[0] : null;
            if (!pageData || !imageFile) {
                alert("Please choose an image first.");
                return;
            }

            const src = URL.createObjectURL(imageFile);
            pageData.overlays.push({
                id: createOverlayId(),
                type: "image",
                src: src,
                mimeType: imageFile.type || "image/png",
                xRatio: 0.18,
                yRatio: 0.22,
                widthRatio: 0.28,
                file: imageFile
            });
            renderEditPdfWorkspace();
        });

        editPdfPageSelect.addEventListener("change", function() {
            editPdfCurrentPage = parseInt(this.value || "0", 10);
            editPdfSelectedOverlayId = null;
            renderEditPdfWorkspace();
        });

        refreshEditPdfPreviewBtn.addEventListener("click", function() {
            renderEditPdfWorkspace();
        });

        removeEditPdfOverlayBtn.addEventListener("click", function() {
            const pageData = getCurrentPageData();
            if (!pageData || !editPdfSelectedOverlayId) {
                alert("Please select an inserted text or image first.");
                return;
            }

            pageData.overlays = pageData.overlays.filter(function(item) {
                return item.id !== editPdfSelectedOverlayId;
            });
            editPdfSelectedOverlayId = null;
            renderEditPdfWorkspace();
        });

        editPdfInput.addEventListener("change", async function() {
            const file = this.files && this.files[0] ? this.files[0] : null;
            editPdfPages = [];
            editPdfCurrentPage = 0;
            editPdfSelectedOverlayId = null;
            editPdfStage.innerHTML = "";
            updateEditPdfVisibility();

            if (!file) {
                setEditPdfStatus("");
                return;
            }

            try {
                setEditPdfStatus("Loading PDF editor workspace...");
                editPdfBytes = await file.arrayBuffer();
                editPdfDoc = await PDFLib.PDFDocument.load(editPdfBytes);
                editPdfViewDoc = await pdfjsLib.getDocument({ data: editPdfBytes }).promise;
                for (let i = 0; i < editPdfDoc.getPageCount(); i++) {
                    editPdfPages.push({ overlays: [] });
                }
                updateEditPdfVisibility();
                rebuildEditPdfPageSelect();
                await renderEditPdfWorkspace();
                setEditPdfStatus("PDF loaded. Add text or pictures and drag them to the right spot.");
            } catch (error) {
                setEditPdfStatus("Could not load this PDF: " + error.message, true);
            }
        });

        downloadEditPdfBtn.addEventListener("click", async function() {
            const pdfFile = editPdfInput.files && editPdfInput.files[0] ? editPdfInput.files[0] : null;
            if (!pdfFile) {
                alert("Please select a PDF file");
                return;
            }

            try {
                setEditPdfStatus("Applying edits to PDF...");
                const pdf = await PDFLib.PDFDocument.load(editPdfBytes);
                const pages = pdf.getPages();
                const fontCache = {};

                for (let i = 0; i < editPdfPages.length; i++) {
                    const page = pages[i];
                    const pageWidth = page.getWidth();
                    const pageHeight = page.getHeight();
                    const overlays = editPdfPages[i].overlays;

                    for (let j = 0; j < overlays.length; j++) {
                        const overlay = overlays[j];
                        if (overlay.type === "text") {
                            let fontName = PDFLib.StandardFonts.Helvetica;
                            if (overlay.style === "bold") fontName = PDFLib.StandardFonts.HelveticaBold;
                            if (overlay.style === "italic") fontName = PDFLib.StandardFonts.HelveticaOblique;
                            if (!fontCache[fontName]) {
                                fontCache[fontName] = await pdf.embedFont(fontName);
                            }

                            const font = fontCache[fontName];
                            const fontSize = Math.max(8, overlay.sizeRatio * 700);
                            const x = overlay.xRatio * pageWidth;
                            const y = pageHeight - (overlay.yRatio * pageHeight) - fontSize;
                            page.drawText(overlay.text, {
                                x: x,
                                y: y,
                                size: fontSize,
                                font: font,
                                color: PDFLib.rgb(0.1, 0.1, 0.1)
                            });
                        } else {
                            const bytes = await overlay.file.arrayBuffer();
                            const image = (overlay.mimeType || "").toLowerCase().indexOf("png") !== -1
                                ? await pdf.embedPng(bytes)
                                : await pdf.embedJpg(bytes);
                            const width = overlay.widthRatio * pageWidth;
                            const scale = width / image.width;
                            const height = image.height * scale;
                            const x = overlay.xRatio * pageWidth;
                            const y = pageHeight - (overlay.yRatio * pageHeight) - height;
                            page.drawImage(image, {
                                x: x,
                                y: y,
                                width: width,
                                height: height
                            });
                        }
                    }
                }

                const out = await pdf.save();
                const a = document.createElement("a");
                a.href = URL.createObjectURL(new Blob([out], { type: "application/pdf" }));
                a.download = getEditPdfBaseName(pdfFile.name) + "_edited.pdf";
                a.click();
                setEditPdfStatus("Edited PDF downloaded successfully.");
            } catch (error) {
                setEditPdfStatus("Could not edit this PDF: " + error.message, true);
            }
        });
    </script>';
}

function getRedactPdfHTML() {
    return '
    <div class="space-y-6">
        <div style="display:none;">
            <h1>Redact PDF Online Free</h1>
            <p>Use this redact PDF tool to redact PDF online free, hide sensitive PDF text, and download a rebuilt redacted copy directly in your browser.</p>
            <p>Learn how to redact PDF for free, redact PDF text online, and create a free redact PDF workflow without Adobe.</p>
        </div>
        <div class="rounded-2xl border border-amber-200/70 bg-amber-50/80 dark:bg-amber-950/30 dark:border-amber-900 p-4">
            <div class="font-semibold text-amber-900 dark:text-amber-100">Redact PDF text visually</div>
            <p class="mt-1 text-sm text-amber-800 dark:text-amber-200">Enter a word or phrase, redact PDF text with black boxes, and download a rebuilt copy for stronger visual redaction.</p>
        </div>
        <div class="rounded-2xl border border-gray-200 dark:border-gray-700 p-5 space-y-4 bg-white dark:bg-gray-900">
            <input type="file" id="redactPdfInput" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" accept=".pdf">
            <input type="text" id="redactKeyword" class="w-full p-4 bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-100 rounded-xl border border-gray-200 dark:border-gray-600" placeholder="Enter keyword or phrase to redact">
            <label class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-300">
                <input type="checkbox" id="redactCaseSensitive" class="rounded border-gray-300">
                Match case exactly
            </label>
            <div class="rounded-2xl border border-blue-100 bg-blue-50/70 dark:bg-blue-950/20 dark:border-blue-900 p-4 text-sm text-blue-900 dark:text-blue-100">
                How to redact PDF:
                Upload the PDF, enter the text you want to hide, choose case-sensitive matching if needed, and download the redacted PDF file.
            </div>
            <button id="redactPdfBtn" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Redact PDF Free</button>
        </div>
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
