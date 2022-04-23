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
            console.log("Parent component mounted!");
            this.getData();
        },
        methods: {
            getData() {
                axios
                    .get("/api/getEmployees")
                    .then((response) => {
                        this.employees = response.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
        },
    };
</script>
