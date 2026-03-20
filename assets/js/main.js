document.addEventListener('DOMContentLoaded', function () {
    const leadForm = document.getElementById('leadForm');
    const responseMessage = document.getElementById('responseMessage');

    if (leadForm) {
        leadForm.addEventListener('submit', function (e) {
            e.preventDefault();
            responseMessage.innerHTML = 'Відправка...';
            responseMessage.style.color = 'blue';
            const formData = new FormData(this);
            const data = Object.fromEntries(formData.entries());

            fetch('/api/api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(async response => {
                const result = await response.json();
                
                if (response.ok) {
                    responseMessage.innerHTML = 'Лід успішно додано!';
                    responseMessage.style.color = 'green';
                    leadForm.reset();
                } else {
                    responseMessage.innerHTML = 'Помилка: ' + (result.message || 'Не вдалося додати лід');
                    responseMessage.style.color = 'red';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                responseMessage.innerHTML = 'Сталася критична помилка при відправці.';
                responseMessage.style.color = 'red';
            });
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const loadLeads = () => {
        const tableBody = document.getElementById('leadsTableBody');
        tableBody.innerHTML = '<tr><td colspan="4" style="text-align: center;">Завантаження...</td></tr>';
        
        fetch('/api/api.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'get_statuses' })
        })
        .then(res => res.json())
        .then(response => {
            if (response.status === true || response.status === "true") {
                let leads = typeof response.data === 'string' 
                            ? JSON.parse(response.data) 
                            : response.data;

                if (leads && leads.length > 0) {
                    tableBody.innerHTML = '';
                    leads.forEach(lead => {
                        tableBody.innerHTML += `
                            <tr>
                                <td>${lead.id || '-'}</td>
                                <td>${lead.email || '-'}</td>
                                <td>${lead.ftd || '-'}</td>
                                <td>${lead.date_ftd || '-'}</td>
                            </tr>
                        `;
                    });
                } else {
                    tableBody.innerHTML = '<tr><td colspan="4" style="text-align: center;">Список порожній</td></tr>';
                }
            } else {
                tableBody.innerHTML = `<tr><td colspan="4" style="text-align: center; color: red;">Помилка: ${response.error || 'Невідома помилка'}</td></tr>`;
            }
        })
        .catch(err => {
            console.error(err);
            tableBody.innerHTML = '<tr><td colspan="4" style="text-align: center; color: red;">Критична помилка запиту</td></tr>';
        });
    };

    if (document.getElementById('leadsTableBody')) {
        loadLeads();
        document.getElementById('refreshList').addEventListener('click', loadLeads);
    }
});