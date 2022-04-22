<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Liste over ansatte</div>

                    <div class="card-body">
                        <table class="table" @employeeAdded="getData()">
                            <thead>
                                <th scope="col">#</th>
                                <th scope="col">Navn</th>
                                <th scope="col">Email</th>
                                <th scope="col">Telefon</th>
                                <th scope="col">Stilling</th>
                            </thead>
                            <tbody>
                                <tr v-for="employee in employees">
                                    <th scope="row">{{ employee.id }}</th>
                                    <td>{{ employee.name }}</td>
                                    <td>{{ employee.email }}</td>
                                    <td>{{ employee.phone }}</td>
                                    <td>{{ employee.position.type }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ["employees"],
        mounted() {
            console.log("Component mounted.");
        },
    };
</script>
