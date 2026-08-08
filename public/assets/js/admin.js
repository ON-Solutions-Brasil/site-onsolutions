/**
 * On Solutions - Admin Panel JavaScript
 */
document.addEventListener('DOMContentLoaded', function() {

    // Sidebar toggle (mobile)
    const sidebar = document.getElementById('adminSidebar');
    document.getElementById('sidebarOpen')?.addEventListener('click', () => sidebar?.classList.add('open'));
    document.getElementById('sidebarClose')?.addEventListener('click', () => sidebar?.classList.remove('open'));

    // Auto-dismiss alerts
    document.querySelectorAll('.alert-dismissible').forEach(alert => {
        setTimeout(() => {
            const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
            bsAlert.close();
        }, 5000);
    });

    // Confirm delete actions
    document.querySelectorAll('[data-confirm]').forEach(el => {
        el.addEventListener('click', function(e) {
            if (!confirm(this.dataset.confirm || 'Tem certeza que deseja excluir?')) {
                e.preventDefault();
            }
        });
    });

    // File input preview
    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function() {
            const preview = this.parentElement.querySelector('.file-preview');
            if (preview && this.files[0]) {
                const reader = new FileReader();
                reader.onload = e => preview.src = e.target.result;
                reader.readAsDataURL(this.files[0]);
            }
        });
    });

    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = document.getElementById(this.dataset.target);
            if (input) {
                input.type = input.type === 'password' ? 'text' : 'password';
            }
        });
    });

    // Custom Select - Inicializar
    initCustomSelects();
});

/**
 * Custom Select - Transforma selects nativos em dropdowns estilizados On Solutions
 */
function initCustomSelects() {
    var selects = document.querySelectorAll('select.form-select:not([data-custom-init])');
    
    for (var i = 0; i < selects.length; i++) {
        buildCustomSelect(selects[i]);
    }
}

function buildCustomSelect(select) {
    select.setAttribute('data-custom-init', 'true');
    select.style.position = 'absolute';
    select.style.opacity = '0';
    select.style.pointerEvents = 'none';
    select.style.width = '0';
    select.style.height = '0';
    select.style.overflow = 'hidden';

    var parent = select.parentNode;

    // Wrapper
    var wrapper = document.createElement('div');
    wrapper.className = 'custom-select-wrapper';

    var customSelect = document.createElement('div');
    customSelect.className = 'custom-select';

    // Trigger
    var trigger = document.createElement('div');
    trigger.className = 'custom-select__trigger';

    var valueSpan = document.createElement('span');
    valueSpan.className = 'custom-select__value';
    var selectedOpt = select.options[select.selectedIndex];
    valueSpan.textContent = selectedOpt ? selectedOpt.textContent.trim() : '-- Selecione --';

    var arrow = document.createElement('i');
    arrow.className = 'bi bi-chevron-down custom-select__arrow';

    trigger.appendChild(valueSpan);
    trigger.appendChild(arrow);
    customSelect.appendChild(trigger);

    // Options
    var optionsContainer = document.createElement('div');
    optionsContainer.className = 'custom-select__options';

    for (var j = 0; j < select.options.length; j++) {
        var opt = select.options[j];
        var optDiv = document.createElement('div');
        optDiv.className = 'custom-select__option';
        optDiv.setAttribute('data-value', opt.value);
        optDiv.textContent = opt.textContent.trim();

        if (j === select.selectedIndex) {
            optDiv.classList.add('is-selected');
        }

        (function(optionDiv, nativeSelect, valSpan, csEl) {
            optionDiv.addEventListener('click', function(e) {
                e.stopPropagation();
                var allOpts = csEl.querySelectorAll('.custom-select__option');
                for (var k = 0; k < allOpts.length; k++) {
                    allOpts[k].classList.remove('is-selected');
                }
                optionDiv.classList.add('is-selected');
                valSpan.textContent = optionDiv.textContent;
                nativeSelect.value = optionDiv.getAttribute('data-value');
                nativeSelect.dispatchEvent(new Event('change', { bubbles: true }));
                csEl.classList.remove('is-open');
            });
        })(optDiv, select, valueSpan, customSelect);

        optionsContainer.appendChild(optDiv);
    }

    customSelect.appendChild(optionsContainer);
    wrapper.appendChild(customSelect);

    // Inserir após o select
    parent.insertBefore(wrapper, select.nextSibling);

    // Toggle
    trigger.addEventListener('click', function(e) {
        e.stopPropagation();
        var allOpen = document.querySelectorAll('.custom-select.is-open');
        for (var m = 0; m < allOpen.length; m++) {
            if (allOpen[m] !== customSelect) allOpen[m].classList.remove('is-open');
        }
        customSelect.classList.toggle('is-open');
    });
}

// Fechar dropdowns ao clicar fora
document.addEventListener('click', function() {
    var openSelects = document.querySelectorAll('.custom-select.is-open');
    for (var i = 0; i < openSelects.length; i++) {
        openSelects[i].classList.remove('is-open');
    }
});
