
document.addEventListener('DOMContentLoaded', () => {
    const userProfile = document.getElementById('user-profile');

    async function renderLoggedOut() {
        userProfile.innerHTML = `
            <button id="btn-login">Login</button>
            <button id="btn-signup">Signup</button>
        `;
        document.getElementById('btn-login').addEventListener('click', () => {
            // Keep compatibility with existing PHP pages until converted
            window.location.href = 'login.html';
        });
        document.getElementById('btn-signup').addEventListener('click', () => {
            window.location.href = 'signup.html';
        });
    }

    async function renderLoggedIn(username) {
        userProfile.innerHTML = `
            <img src="images/user.svg" alt="User Profile"/>
            <span>Welcome, ${username}</span>
            <button id="btn-logout">Logout</button>
        `;
        document.getElementById('btn-logout').addEventListener('click', async () => {
            try {
                const res = await fetch('/api/logout', { method: 'POST', credentials: 'include' });
                if (res.ok) {
                    window.location.reload();
                } else {
                    console.error('Logout failed');
                }
            } catch (err) {
                console.error('Logout error', err);
            }
        });
    }

    // Check logged-in user
    (async () => {
        try {
            const res = await fetch('/api/user', { credentials: 'include' });
            if (res.ok) {
                const data = await res.json();
                if (data && data.username) {
                    renderLoggedIn(data.username);
                    return;
                }
            }
            // Not logged in
            renderLoggedOut();
        } catch (err) {
            console.error('Error checking login status', err);
            renderLoggedOut();
        }
    })();
});