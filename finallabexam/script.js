async function loadEmployees() {
    const response = await fetch('employees.php');
    const employees = await response.json();
    const list = document.getElementById('employeeList');
    list.innerHTML = employees.map(emp => `<p>${emp.name} (${emp.username})</p>`).join('');
}

document.getElementById('searchInput').addEventListener('input', async (e) => {
    const query = e.target.value;
    const response = await fetch(`employees.php?search=${query}`);
    const employees = await response.json();
    const list = document.getElementById('employeeList');
    list.innerHTML = employees.map(emp => `<p>${emp.name} (${emp.username})</p>`).join('');
});
