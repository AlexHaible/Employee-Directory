
<template>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Indsæt ny ansat</div>

                    <div class="card-body">
                        <form>
                            <fieldset :disabled="loading">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="name" class="form-label">Navn</label>
                                    <input id="name" type="text" class="form-control" :class="{ 'is-invalid': error.name }" v-model="name" @input="delete error.name" minlength="1" maxlength="255" required>
                                    <small >{{ error.name }} </small>
                                </div>
                                <div class="col">
                                    <label for="email" class="form-label">E-Mail Adresse</label>
                                    <input id="email" type="email" class="form-control" :class="{ 'is-invalid': error.email }" v-model="email" @input="delete error.email" minlength="1" maxlength="255" required>
                                    <small >{{ error.email }} </small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="phone" class="form-label">Telefon</label>
                                    <input id="phone" type="tel" class="form-control" :class="{ 'is-invalid': error.phone }" v-model="phone" @input="delete error.phone" minlength="8" maxlength="8" required>
                                    <small >{{ error.phone }} </small>
                                </div>
                                <div class="col">
                                    <label for="position" class="form-label">Stilling</label>
                                    <select name="position" id="position" class="form-select" :class="{ 'is-invalid': error.position }" v-model="position" @select="delete error.position" required>
                                        <option value="notChosen">Vælg venligst...</option>
                                        <option v-for="position in positions" :value="position.id">{{ position.type }}</option>
                                    </select>
                                    <small >{{ error.position }} </small>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-25" ref="submitBtn" @click.prevent="handleSubmit">Submit</button>
                            <button class="btn btn-secondary w-25" ref="clearBtn" @click.prevent="clearForm">Ryd</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: "",
                email: "",
                phone: "",
                position: "",
                error: {
                    name: "",
                    email: "",
                    phone: "",
                    position: "",
                },
                positions: [],
                loading: false,
                submit: {
                    spinner:
                        "<div class='spinner-border text-light' role='status'><span class='visually-hidden'>Loading...</span></div>",
                    text: "Submit",
                },
            };
        },
        mounted() {
            console.log("New employee form mounted!");
            this.getPositions();
        },
        methods: {
            handleSubmit() {
                this.loading = true;
                this.$refs.submitBtn.innerHTML = this.submit.spinner;
                if (
                    this.name !== "" &&
                    this.email !== "" &&
                    this.phone !== "" &&
                    this.position !== ""
                ) {
                    axios
                        .post("api/submitNewEmployee", {
                            name: this.name,
                            email: this.email,
                            phone: this.phone,
                            position: this.position,
                        })
                        .then((response) => {
                            this.$emit("employeeAdded");
                            this.clearForm();
                            console.log(response);
                        })
                        .catch((error) => {
                            console.error(error);
                            this.error.name = error.response.data.error.name;
                            this.error.email = error.response.data.error.email;
                            this.error.phone = error.response.data.error.phone;
                            this.error.position =
                                error.response.data.error.position;
                        })
                        .finally(() => {
                            this.loading = false;
                            this.$refs.submitBtn.innerHTML = this.submit.text;
                        });
                } else {
                    this.loading = false;
                    this.$refs.submitBtn.innerHTML = this.submit.text;
                    return alert(
                        "One of your fields is empty, please rectify this."
                    );
                }
            },
            getPositions() {
                axios
                    .get("/api/getPositions")
                    .then((response) => {
                        this.positions = response.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            clearForm() {
                this.name = "";
                this.email = "";
                this.phone = "";
                this.position = "";
                this.error_name = "";
                this.error_email = "";
                this.error_phone = "";
                this.error_position = "";
            },
        },
    };
</script>
