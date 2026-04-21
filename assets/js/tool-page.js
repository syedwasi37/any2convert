const toolDependencyMap = {
    img_to_pdf: ["https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"],
    protect_pdf: ["https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"],
    bank_statement_to_excel: [
        "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js",
        "https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"
    ],
};

function loadScriptOnce(src) {
    window.__any2convertLoadedScripts = window.__any2convertLoadedScripts || {};
    if (window.__any2convertLoadedScripts[src]) {
        return window.__any2convertLoadedScripts[src];
    }
    window.__any2convertLoadedScripts[src] = new Promise((resolve, reject) => {
        const script = document.createElement('script');
        script.src = src;
        script.async = false;
        script.dataset.src = src;
        script.onload = () => {
            if (src.includes('/pdf.js/')) {
                window.pdfjsLib && (window.pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js");
            }
            resolve();
        };
        script.onerror = () => reject(new Error('Failed to load required library.'));
        document.body.appendChild(script);
    });
    return window.__any2convertLoadedScripts[src];
}

function ensureToolDependencies(toolId) {
    const dependencies = toolDependencyMap[toolId] || [];
    return Promise.all(dependencies.map(loadScriptOnce));
}

window.any2convertLeaderboard = {
    escape(value) {
        return String(value ?? '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;');
    },
    async fetch(toolKey) {
        const response = await fetch(`backend/leaderboard.php?tool=${encodeURIComponent(toolKey)}`, {
            credentials: 'same-origin'
        });
        const data = await response.json().catch(() => ({}));
        if (!response.ok) {
            throw new Error(data.error || 'Could not load leaderboard.');
        }
        return data;
    },
    async save(toolKey, payload) {
        const response = await fetch('backend/save_leaderboard_score.php', {
            method: 'POST',
            credentials: 'same-origin',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ tool: toolKey, ...payload })
        });
        const data = await response.json().catch(() => ({}));
        if (!response.ok) {
            throw new Error(data.error || 'Could not save leaderboard score.');
        }
        return data;
    },
    render(container, data, options = {}) {
        if (!container) return;
        const emptyText = options.emptyText || 'No scores yet. Be the first to set one.';
        const loginText = options.loginText || 'Log in to save your result on the public leaderboard.';
        const entries = Array.isArray(data?.entries) ? data.entries : [];

        if (!entries.length) {
            container.innerHTML = `
                <div class="rounded-2xl border border-dashed border-slate-200 dark:border-slate-800 px-4 py-5 text-sm text-slate-500 dark:text-slate-400">
                    ${this.escape(emptyText)}
                    <div class="mt-2 text-xs uppercase tracking-[0.18em] ${data?.authenticated ? 'text-emerald-500 dark:text-emerald-300' : 'text-slate-400'}">
                        ${this.escape(data?.authenticated ? 'Your next strong run can take the top spot.' : loginText)}
                    </div>
                </div>
            `;
            return;
        }

        container.innerHTML = entries.map((entry) => `
            <div class="flex items-start justify-between gap-3 rounded-2xl border border-slate-200/80 dark:border-slate-800 bg-white/80 dark:bg-slate-900/70 px-4 py-3">
                <div class="min-w-0">
                    <div class="flex items-center gap-2">
                        <span class="inline-flex h-7 w-7 items-center justify-center rounded-full bg-slate-900 text-xs font-black text-white dark:bg-white dark:text-slate-900">${entry.rank}</span>
                        <span class="truncate text-sm font-bold text-slate-900 dark:text-white">${this.escape(entry.display_name)}</span>
                    </div>
                    ${entry.score_meta ? `<div class="mt-2 text-xs text-slate-500 dark:text-slate-400">${this.escape(entry.score_meta)}</div>` : ''}
                </div>
                <div class="shrink-0 text-right">
                    <div class="text-sm font-black text-slate-900 dark:text-white">${this.escape(entry.score_label)}</div>
                </div>
            </div>
        `).join('');
    }
};

async function executeScripts(container) {
    document.querySelectorAll('script[data-dynamic-tool-script="1"]').forEach((script) => script.remove());
    const scripts = Array.from(container.querySelectorAll('script'));

    for (const oldScript of scripts) {
        const newScript = document.createElement('script');
        newScript.dataset.dynamicToolScript = '1';

        if (oldScript.src) {
            await new Promise((resolve, reject) => {
                newScript.src = oldScript.src;
                newScript.async = false;
                newScript.onload = resolve;
                newScript.onerror = () => reject(new Error(`Failed to load script: ${oldScript.src}`));
                oldScript.parentNode.removeChild(oldScript);
                document.body.appendChild(newScript);
            });
        } else {
            newScript.textContent = oldScript.textContent;
            oldScript.parentNode.removeChild(oldScript);
            document.body.appendChild(newScript);
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const modalContent = document.getElementById('modalContent');
    const toolId = modalContent?.dataset.toolId || '';

    ensureToolDependencies(toolId).then(() => {
        if (modalContent) {
            executeScripts(modalContent);
        }
    }).catch(() => {
        if (modalContent) {
            modalContent.innerHTML = '<div style="padding:24px;text-align:center;color:#ef4444;">A required tool library could not be loaded.</div>';
        }
    });
});
