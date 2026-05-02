import 'bootstrap';

window.csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ?? '';

const iconFilledMarkup = `
    <svg viewBox="0 0 24 24" aria-hidden="true" class="h-5 w-5">
        <path fill="currentColor" d="M12 21c-.33 0-.66-.1-.94-.28C7.24 18.1 4 14.8 4 10.88 4 8.1 6.18 6 8.98 6c1.36 0 2.68.55 3.62 1.5C13.55 6.55 14.86 6 16.23 6 19.03 6 21 8.1 21 10.88c0 3.9-3.24 7.2-7.06 9.84-.28.18-.61.28-.94.28Z" />
        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.4" d="M12 21c-.33 0-.66-.1-.94-.28C7.24 18.1 4 14.8 4 10.88 4 8.1 6.18 6 8.98 6c1.36 0 2.68.55 3.62 1.5C13.55 6.55 14.86 6 16.23 6 19.03 6 21 8.1 21 10.88c0 3.9-3.24 7.2-7.06 9.84-.28.18-.61.28-.94.28Z" />
    </svg>
`;

const iconOutlineMarkup = `
    <svg viewBox="0 0 24 24" aria-hidden="true" class="h-5 w-5">
        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 21c-.33 0-.66-.1-.94-.28C7.24 18.1 4 14.8 4 10.88 4 8.1 6.18 6 8.98 6c1.36 0 2.68.55 3.62 1.5C13.55 6.55 14.86 6 16.23 6 19.03 6 21 8.1 21 10.88c0 3.9-3.24 7.2-7.06 9.84-.28.18-.61.28-.94.28Z" />
        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M8.7 8.2c-.94.2-1.8.76-2.3 1.63" />
    </svg>
`;

function setFavoriteButtonState(button, isActive) {
    button.setAttribute('aria-pressed', isActive ? 'true' : 'false');
    button.classList.toggle('is-active', isActive);

    const icon = button.querySelector('[data-favorite-icon]');
    if (icon) {
        icon.innerHTML = isActive ? iconFilledMarkup : iconOutlineMarkup;
    }

    const label = button.querySelector('[data-favorite-label]');
    if (label) {
        label.textContent = isActive ? 'Saved' : 'Save';
    }
}

function updateFavoriteCounts(nextCount) {
    if (typeof nextCount === 'undefined') {
        return;
    }

    document.querySelectorAll('[data-favorites-count]').forEach((element) => {
        element.textContent = nextCount;
    });
}

async function toggleFavorite(button) {
    if (!button || button.classList.contains('is-busy')) {
        return;
    }

    const characterId = button.dataset.favoriteId;
    if (!characterId) {
        return;
    }

    const wasActive = button.getAttribute('aria-pressed') === 'true';
    button.classList.add('is-busy');
    setFavoriteButtonState(button, !wasActive);

    try {
        const response = await fetch(button.dataset.favoriteUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': window.csrfToken,
            },
            body: JSON.stringify({
                character_id: Number(characterId),
                character_name: button.dataset.favoriteName ?? '',
                character_image: button.dataset.favoriteImage ?? '',
            }),
        });

        const payload = await response.json().catch(() => ({}));

        if (!response.ok) {
            throw new Error(payload.message ?? 'Unable to update favorite.');
        }

        const isActive = payload.status === 'added';
        setFavoriteButtonState(button, isActive);
        updateFavoriteCounts(payload.favorites_count);

        const card = button.closest('[data-favorite-card]');
        if (card && payload.status === 'removed' && button.dataset.removeCardOnUnfavorite === 'true') {
            const grid = card.parentElement;
            card.remove();

            if (grid && !grid.querySelector('[data-favorite-card]')) {
                const emptyState = document.querySelector('[data-favorites-empty]');
                if (emptyState) {
                    emptyState.classList.remove('hidden');
                }
            }
        }

        document.dispatchEvent(
            new CustomEvent('favorite:changed', {
                detail: {
                    characterId: Number(characterId),
                    status: payload.status,
                    favoritesCount: payload.favorites_count,
                },
            }),
        );
    } catch (error) {
        console.error(error);
        setFavoriteButtonState(button, wasActive);
        window.alert('Unable to update favorites right now. Please try again.');
    } finally {
        button.classList.remove('is-busy');
    }
}

function togglePasswordField(button) {
    const target = document.querySelector(button.dataset.passwordToggle);
    if (!target) {
        return;
    }

    const nextType = target.type === 'password' ? 'text' : 'password';
    target.type = nextType;
    button.setAttribute('aria-pressed', nextType === 'text' ? 'true' : 'false');
}

function updatePasswordStrength(input) {
    const meter = document.querySelector(input.dataset.passwordStrength);
    const label = document.querySelector(input.dataset.passwordStrengthLabel);

    if (!meter || !label) {
        return;
    }

    const value = input.value;
    let score = 0;

    if (value.length >= 8) score += 1;
    if (/[a-z]/.test(value) && /[A-Z]/.test(value)) score += 1;
    if (/\d/.test(value)) score += 1;
    if (/[^A-Za-z0-9]/.test(value)) score += 1;

    meter.style.setProperty('--strength', score.toString());

    if (!value.length) {
        label.textContent = 'Password strength: none';
        return;
    }

    const labels = ['very weak', 'fair', 'good', 'strong'];
    label.textContent = `Password strength: ${labels[Math.max(score - 1, 0)]}`;
}

function updatePasswordMatch(input) {
    const message = document.querySelector(input.dataset.passwordMatchMessage);
    const source = document.querySelector(input.dataset.passwordMatchTarget);

    if (!message || !source) {
        return;
    }

    if (!input.value.length) {
        message.textContent = '';
        message.classList.add('hidden');
        return;
    }

    const matches = input.value === source.value;
    message.classList.remove('hidden');
    message.textContent = matches ? 'Passwords match.' : 'Passwords do not match.';
    message.classList.toggle('text-[var(--rm-portal)]', matches);
    message.classList.toggle('text-[var(--rm-danger)]', !matches);
}

function seedParticleFields() {
    document.querySelectorAll('[data-particle-field]').forEach((field) => {
        if (field.dataset.seeded === 'true') {
            return;
        }

        field.dataset.seeded = 'true';

        for (let index = 0; index < 18; index += 1) {
            const particle = document.createElement('span');
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.top = `${Math.random() * 100}%`;
            particle.style.animationDuration = `${6 + Math.random() * 8}s`;
            particle.style.animationDelay = `${Math.random() * 3}s`;
            field.appendChild(particle);
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    seedParticleFields();

    document.querySelectorAll('[data-favorite-toggle]').forEach((button) => {
        setFavoriteButtonState(button, button.getAttribute('aria-pressed') === 'true');
    });
});

document.addEventListener('click', (event) => {
    const navToggle = event.target.closest('[data-nav-toggle]');
    if (navToggle) {
        const target = document.querySelector(navToggle.dataset.navToggle);
        if (target) {
            target.classList.toggle('is-open');
            target.classList.toggle('hidden');
        }
        return;
    }

    const favoriteButton = event.target.closest('[data-favorite-toggle]');
    if (favoriteButton) {
        event.preventDefault();
        toggleFavorite(favoriteButton);
        return;
    }

    const passwordToggle = event.target.closest('[data-password-toggle]');
    if (passwordToggle) {
        event.preventDefault();
        togglePasswordField(passwordToggle);
        return;
    }

    const modalOpen = event.target.closest('[data-modal-open]');
    if (modalOpen) {
        const modal = document.querySelector(modalOpen.dataset.modalOpen);
        modal?.classList.remove('hidden');
        return;
    }

    const modalClose = event.target.closest('[data-modal-close]');
    if (modalClose) {
        const modal = document.querySelector(modalClose.dataset.modalClose);
        modal?.classList.add('hidden');
        return;
    }
});

document.addEventListener('input', (event) => {
    const strengthInput = event.target.closest('[data-password-strength]');
    if (strengthInput) {
        updatePasswordStrength(strengthInput);
    }

    const matchInput = event.target.closest('[data-password-match-target]');
    if (matchInput) {
        updatePasswordMatch(matchInput);
    }
});
