/**
 * On Solutions - Admin Panel JavaScript
 */
document.addEventListener('DOMContentLoaded', function() {

    // Sidebar toggle (mobile)
    var sidebar = document.getElementById('adminSidebar');
    var openBtn = document.getElementById('sidebarOpen');
    var closeBtn = document.getElementById('sidebarClose');
    if (openBtn) openBtn.addEventListener('click', function() { if (sidebar) sidebar.classList.add('open'); });
    if (closeBtn) closeBtn.addEventListener('click', function() { if (sidebar) sidebar.classList.remove('open'); });

    // Auto-dismiss alerts
    document.querySelectorAll('.alert-dismissible').forEach(function(alert) {
        setTimeout(function() {
            try {
                var bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                bsAlert.close();
            } catch(e) {}
        }, 5000);
    });

    // Confirm delete actions
    document.querySelectorAll('[data-confirm]').forEach(function(el) {
        el.addEventListener('click', function(e) {
            if (!confirm(this.dataset.confirm || 'Tem certeza que deseja excluir?')) {
                e.preventDefault();
            }
        });
    });

    // File input preview
    document.querySelectorAll('input[type="file"]').forEach(function(input) {
        input.addEventListener('change', function() {
            var preview = this.parentElement.querySelector('.file-preview');
            if (preview && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) { preview.src = e.target.result; };
                reader.readAsDataURL(this.files[0]);
            }
        });
    });

    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var input = document.getElementById(this.dataset.target);
            if (input) {
                input.type = input.type === 'password' ? 'text' : 'password';
            }
        });
    });

    // Inicializar Custom Selects globais
    transformAllSelects();
});

/**
 * Custom Select Global - Transforma todos os <select> nativos em dropdowns On Solutions
 */
function transformAllSelects() {
    var selects = document.querySelectorAll('select.form-select:not([data-cs-done])');

    for (var i = 0; i < selects.length; i++) {
        transformSelect(selects[i]);
    }
}

function transformSelect(nativeSelect) {
    // Marcar como processado
    nativeSelect.setAttribute('data-cs-done', '1');

    // Esconder o select nativo (mantém no DOM para submit do form)
    nativeSelect.style.position = 'absolute';
    nativeSelect.style.width = '1px';
    nativeSelect.style.height = '1px';
    nativeSelect.style.opacity = '0';
    nativeSelect.style.overflow = 'hidden';
    nativeSelect.style.pointerEvents = 'none';
    nativeSelect.style.clip = 'rect(0,0,0,0)';

    // Criar estrutura custom
    var wrapper = document.createElement('div');
    wrapper.className = 'custom-select-wrapper';

    var cs = document.createElement('div');
    cs.className = 'custom-select';

    // Trigger
    var trigger = document.createElement('div');
    trigger.className = 'custom-select__trigger';

    var valueSpan = document.createElement('span');
    valueSpan.className = 'custom-select__value';
    var selOpt = nativeSelect.options[nativeSelect.selectedIndex];
    valueSpan.textContent = selOpt ? selOpt.textContent.trim() : '-- Selecione --';

    var arrow = document.createElement('i');
    arrow.className = 'bi bi-chevron-down custom-select__arrow';

    trigger.appendChild(valueSpan);
    trigger.appendChild(arrow);
    cs.appendChild(trigger);

    // Options container
    var optionsBox = document.createElement('div');
    optionsBox.className = 'custom-select__options';

    for (var j = 0; j < nativeSelect.options.length; j++) {
        var nOpt = nativeSelect.options[j];
        var optDiv = document.createElement('div');
        optDiv.className = 'custom-select__option';
        optDiv.setAttribute('data-value', nOpt.value);
        optDiv.textContent = nOpt.textContent.trim();

        if (j === nativeSelect.selectedIndex) {
            optDiv.classList.add('is-selected');
        }

        // Click handler
        (function(od, ns, vs, csEl, ob) {
            od.addEventListener('click', function(e) {
                e.stopPropagation();
                var allO = ob.querySelectorAll('.custom-select__option');
                for (var k = 0; k < allO.length; k++) { allO[k].classList.remove('is-selected'); }
                od.classList.add('is-selected');
                vs.textContent = od.textContent;
                ns.value = od.getAttribute('data-value');
                ns.dispatchEvent(new Event('change', { bubbles: true }));
                csEl.classList.remove('is-open');
            });
        })(optDiv, nativeSelect, valueSpan, cs, optionsBox);

        optionsBox.appendChild(optDiv);
    }

    cs.appendChild(optionsBox);
    wrapper.appendChild(cs);

    // Inserir no DOM após o select nativo
    nativeSelect.parentNode.insertBefore(wrapper, nativeSelect.nextSibling);

    // Toggle open/close
    trigger.addEventListener('click', function(e) {
        e.stopPropagation();
        // Fechar outros abertos
        var openOnes = document.querySelectorAll('.custom-select.is-open');
        for (var m = 0; m < openOnes.length; m++) {
            if (openOnes[m] !== cs) openOnes[m].classList.remove('is-open');
        }
        cs.classList.toggle('is-open');
    });
}

// Fechar todos ao clicar fora
document.addEventListener('click', function() {
    var openSelects = document.querySelectorAll('.custom-select.is-open');
    for (var i = 0; i < openSelects.length; i++) {
        openSelects[i].classList.remove('is-open');
    }
});
