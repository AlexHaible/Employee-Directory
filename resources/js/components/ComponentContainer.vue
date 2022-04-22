<template>
    <div>
        <list-employees-table :employees="employees"></list-employees-table>
        <submit-employee-form @employeeAdded="getData"></submit-employee-form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                employees: [],
            };
        },
        mounted() {
            console.log("Component mounted.");
            this.getData();
        },
        methods: {
            getData() {
                axios
                    .get("/api/getEmployees")
                    .then((response) => {
                        console.log(response.data);
                        this.employees = response.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
        },
    };
</script>
