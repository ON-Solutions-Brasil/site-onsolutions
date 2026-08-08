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
});

/**
 * Custom Select - Transforma selects nativos em dropdowns estilizados
 */
(function() {
    function initCustomSelects() {
        document.querySelectorAll('.form-select:not([data-custom-init])').forEach(function(select) {
            // Marcar como já inicializado
            select.setAttribute('data-custom-init', 'true');
            
            // Esconder o select nativo
            select.style.display = 'none';

            // Criar wrapper
            const wrapper = document.createElement('div');
            wrapper.className = 'custom-select-wrapper';

            const customSelect = document.createElement('div');
            customSelect.className = 'custom-select';

            // Trigger
            const trigger = document.createElement('div');
            trigger.className = 'custom-select__trigger';

            const valueSpan = document.createElement('span');
            valueSpan.className = 'custom-select__value';
            valueSpan.textContent = select.options[select.selectedIndex]?.textContent?.trim() || '-- Selecione --';

            const arrow = document.createElement('i');
            arrow.className = 'bi bi-chevron-down custom-select__arrow';

            trigger.appendChild(valueSpan);
            trigger.appendChild(arrow);

            // Options container
            const optionsContainer = document.createElement('div');
            optionsContainer.className = 'custom-select__options';

            Array.from(select.options).forEach(function(option, index) {
                const optionDiv = document.createElement('div');
                optionDiv.className = 'custom-select__option';
                if (index === select.selectedIndex) optionDiv.classList.add('is-selected');
                optionDiv.dataset.value = option.value;
                optionDiv.textContent = option.textContent.trim();

                optionDiv.addEventListener('click', function(e) {
                    e.stopPropagation();
                    optionsContainer.querySelectorAll('.custom-select__option').forEach(o => o.classList.remove('is-selected'));
                    optionDiv.classList.add('is-selected');
                    valueSpan.textContent = optionDiv.textContent;
                    select.value = optionDiv.dataset.value;
                    select.dispatchEvent(new Event('change', { bubbles: true }));
                    customSelect.classList.remove('is-open');
                });

                optionsContainer.appendChild(optionDiv);
            });

            // Montar estrutura
            customSelect.appendChild(trigger);
            customSelect.appendChild(optionsContainer);
            wrapper.appendChild(customSelect);

            // Inserir no DOM
            select.parentNode.insertBefore(wrapper, select.nextSibling);

            // Toggle dropdown
            trigger.addEventListener('click', function(e) {
                e.stopPropagation();
                document.querySelectorAll('.custom-select.is-open').forEach(function(s) {
                    if (s !== customSelect) s.classList.remove('is-open');
                });
                customSelect.classList.toggle('is-open');
            });
        });
    }

    // Fechar ao clicar fora
    document.addEventListener('click', function() {
        document.querySelectorAll('.custom-select.is-open').forEach(function(s) {
            s.classList.remove('is-open');
        });
    });

    // Inicializar
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initCustomSelects);
    } else {
        initCustomSelects();
    }

    // Expor para uso dinâmico
    window.initCustomSelects = initCustomSelects;
})();
