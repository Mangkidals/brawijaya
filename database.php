<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flexible Table with CRUD</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Add SweetAlert2 for better alerts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 p-8">
    <!-- Add Row Button -->
    <div class="max-w-7xl mx-auto mb-4">
        <button onclick="openAddModal()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors">
            Add New Row
        </button>
    </div>

    <!-- Table Container -->
    <div class="max-w-7xl mx-auto">
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="tableBody">
                    <!-- Table rows will be inserted here by JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add/Edit Modal -->
    <div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white rounded-lg p-8 max-w-md w-full">
            <h2 id="modalTitle" class="text-2xl font-bold mb-4">Add New Row</h2>
            <form id="rowForm" onsubmit="handleSubmit(event)">
                <input type="hidden" id="rowId">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" id="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Role</label>
                        <select id="role" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                            <option value="Editor">Editor</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select id="status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="closeModal()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Sample initial data
        let tableData = [
            { id: 1, name: "John Doe", email: "john@example.com", role: "Admin", status: "Active", date: "2024-01-01" },
            { id: 2, name: "Jane Smith", email: "jane@example.com", role: "User", status: "Inactive", date: "2024-01-02" },
            { id: 3, name: "Bob Johnson", email: "bob@example.com", role: "Editor", status: "Pending", date: "2024-01-03" },
            { id: 4, name: "Alice Brown", email: "alice@example.com", role: "Admin", status: "Active", date: "2024-01-04" },
            { id: 5, name: "Charlie Davis", email: "charlie@example.com", role: "User", status: "Active", date: "2024-01-05" },
            { id: 6, name: "Eve Wilson", email: "eve@example.com", role: "Editor", status: "Inactive", date: "2024-01-06" },
            { id: 7, name: "Frank Miller", email: "frank@example.com", role: "User", status: "Pending", date: "2024-01-07" }
        ];

        // Function to get status badge color
        function getStatusColor(status) {
            switch(status.toLowerCase()) {
                case 'active': return 'bg-green-100 text-green-800';
                case 'inactive': return 'bg-red-100 text-red-800';
                case 'pending': return 'bg-yellow-100 text-yellow-800';
                default: return 'bg-gray-100 text-gray-800';
            }
        }

        // Function to render table
        function renderTable() {
            const tableBody = document.getElementById('tableBody');
            tableBody.innerHTML = tableData.map(row => `
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${row.id}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${row.name}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${row.email}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${row.role}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${getStatusColor(row.status)}">
                            ${row.status}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${row.date}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <button onclick="editRow(${row.id})" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                        <button onclick="deleteRow(${row.id})" class="text-red-600 hover:text-red-900">Delete</button>
                    </td>
                </tr>
            `).join('');
        }

        // Function to open modal
        function openAddModal() {
            document.getElementById('modalTitle').textContent = 'Add New Row';
            document.getElementById('rowForm').reset();
            document.getElementById('modal').classList.remove('hidden');
            document.getElementById('modal').classList.add('flex');
        }

        // Function to close modal
        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
            document.getElementById('modal').classList.remove('flex');
        }

        // Function to edit row
        function editRow(id) {
            const row = tableData.find(row => row.id === id);
            if (row) {
                document.getElementById('modalTitle').textContent = 'Edit Row';
                document.getElementById('rowId').value = row.id;
                document.getElementById('name').value = row.name;
                document.getElementById('email').value = row.email;
                document.getElementById('role').value = row.role;
                document.getElementById('status').value = row.status;
                document.getElementById('modal').classList.remove('hidden');
                document.getElementById('modal').classList.add('flex');
            }
        }

        // Function to delete row
        function deleteRow(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    tableData = tableData.filter(row => row.id !== id);
                    renderTable();
                    Swal.fire(
                        'Deleted!',
                        'Your row has been deleted.',
                        'success'
                    );
                }
            });
        }

        // Function to handle form submission
        function handleSubmit(event) {
            event.preventDefault();
            const formData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                role: document.getElementById('role').value,
                status: document.getElementById('status').value,
                date: new Date().toISOString().split('T')[0]
            };

            const rowId = document.getElementById('rowId').value;
            if (rowId) {
                // Edit existing row
                const index = tableData.findIndex(row => row.id === parseInt(rowId));
                if (index !== -1) {
                    tableData[index] = { ...tableData[index], ...formData };
                }
            } else {
                // Add new row
                const newId = Math.max(...tableData.map(row => row.id)) + 1;
                tableData.push({ id: newId, ...formData });
            }

            renderTable();
            closeModal();
            Swal.fire({
                icon: 'success',
                title: rowId ? 'Row Updated!' : 'Row Added!',
                showConfirmButton: false,
                timer: 1500
            });
        }

        // Initial render
        renderTable();
    </script>
</body>
</html>