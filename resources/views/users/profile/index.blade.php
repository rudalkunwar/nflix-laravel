@include('users.layouts.app')
<div class="flex h-screen">
    <!-- Sidebar -->
    <div class="w-64 bg-gray-800 text-white p-6">
        <!-- Sidebar content -->
        Sidebar
    </div>

    <div class="flex-1 flex flex-col p-6">
        <!-- Header -->
        <div class="bg-gray-900 text-white py-4 px-6 mb-6">
            <h2 class="text-2xl">Settings</h2>
        </div>

        <div class="flex-1 bg-gray-100 rounded-lg">
            <!-- Account Settings -->
            <div class="bg-white shadow p-6 mx-6 mb-6 rounded">
                <h3 class="text-lg mb-4 font-semibold">Account Settings</h3>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Username
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text" placeholder="Username" />
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="email" placeholder="Email" />
                </div>

                <div class="mt-6">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="button">
                        Save Changes
                    </button>
                </div>
            </div>

            <!-- Other Settings -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mx-6">
                <div class="bg-white shadow p-6 rounded">
                    <h3 class="text-lg mb-4 font-semibold">Notifications</h3>
                    <p class="text-gray-700">
                        Receive email notifications for updates and promotions.
                    </p>
                </div>

                <div class="bg-white shadow p-6 rounded">
                    <h3 class="text-lg mb-4 font-semibold">Privacy Settings</h3>
                    <p class="text-gray-700">
                        Control who can see your profile and activity status.
                    </p>
                </div>
            </div>

            <!-- Users Settings -->
            <div class="bg-white shadow p-6 mx-6 mt-6 rounded">
                <h3 class="text-lg mb-4 font-semibold">Users Settings</h3>

                <div class="overflow-hidden">
                    <h4 class="text-xl mb-4">User List</h4>
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr>
                                <th class="border-b p-2">ID</th>
                                <th class="border-b p-2">Name</th>
                                <th class="border-b p-2">Email</th>
                                <th class="border-b p-2">Email Verified</th>
                                <th class="border-b p-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Replace with dynamic rows -->
                            <tr>
                                <td class="border-b p-2">1</td>
                                <td class="border-b p-2">John Doe</td>
                                <td class="border-b p-2">john@example.com</td>
                                <td class="border-b p-2">Yes</td>
                                <td class="border-b p-2">
                                    <button class="text-red-600">
                                        <!-- Trash icon here -->
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            <!-- More rows -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
