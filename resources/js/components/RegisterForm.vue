<template>
    <div>
        <div class="row py-4 bg-lightgray" style="position: relative;">
            <div v-if="registerSuccess" class="white-overlay"></div>
            <div class="title text-left col-md-8 mx-auto">
                <h1>Registration</h1>
            </div>
            <div class="form-wrapper col-md-8 mx-auto">
                <form @submit.prevent="registerUser">
                    <div class="form-group">
                        <div class="tooltip-wrapper">
                            <div class="custom-tooltip" v-if="errors.mobile_number">
                                {{ errors.mobile_number[0] }}
                            </div>
                            <input type="text" class="form-control" name="mobile_number" v-model="mobile_number" placeholder="Mobile Number">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="tooltip-wrapper">
                            <div class="custom-tooltip" v-if="errors.first_name">
                                {{ errors.first_name[0] }}
                            </div>
                            <input type="text" class="form-control" name="first_name" v-model="first_name" placeholder="First Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="tooltip-wrapper">
                            <div class="custom-tooltip" v-if="errors.last_name">
                                {{ errors.last_name[0] }}
                            </div>
                            <input type="text" class="form-control" name="last_name" v-model="last_name" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <select name="month" class="custom-select" v-model="month">
                                <option disabled readonly value selected>Month</option>
                                <option v-for="monthVal in populateMonth" :key="monthVal.value" :value="monthVal.value">{{ monthVal.name }}</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="date" class="custom-select" v-model="date">
                                <option disabled readonly value selected>Date</option>
                                <option v-for="dateVal in populateDate" :value="dateVal">{{ dateVal }}</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="tooltip-wrapper">
                                <div class="custom-tooltip dob" v-if="errors.date_of_birth">
                                    {{ errors.date_of_birth[0] }}
                                </div>
                                <select name="year" class="custom-select" v-model="year">
                                    <option disabled readonly value selected>Year</option>
                                    <option v-for="yearVal in populateYear" :value="yearVal">{{ yearVal }}</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <div class="tooltip-wrapper">
                            <div class="custom-tooltip" v-if="errors.gender">
                                {{ errors.gender[0] }}
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" v-model="gender" value="Male">
                                <label class="form-check-label" style="color:#000;">
                                    Male
                                </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" v-model="gender" value="Female">
                                <label class="form-check-label" style="color:#000;">
                                    Female
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="tooltip-wrapper">
                            <div class="custom-tooltip" v-if="errors.email">
                                {{ errors.email[0] }}
                            </div>
                            <input type="text" class="form-control" name="email" v-model="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn blue-violet form-control" value="Register">
                    </div>
                </form>
            </div>
        </div>
        <div class="row bg-lightgray py-4" v-if="registerSuccess">
            <div class="col-md-8 mx-auto">
                <button type="button" class="btn blue-violet form-control" @click="goToLogin">Login</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['registerUrlVal', 'loginUrlVal'],
        created() {
            this.getDate()
            this.getYear()
        },
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                registerUrl: this.registerUrlVal,
                loginUrl: this.loginUrlVal,
                populateMonth: [{
                    name: 'January',
                    value: '01'
                },
                {
                    name: 'February',
                    value: '02'
                },
                {
                    name: 'March',
                    value: '03'
                },
                {
                    name: 'April',
                    value: '04'
                },
                {
                    name: 'May',
                    value: '05'
                },
                {
                    name: 'June',
                    value: '06'
                },
                {
                    name: 'July',
                    value: '07'
                },
                {
                    name: 'August',
                    value: '08'
                },
                {
                    name: 'September',
                    value: '09'
                },
                {
                    name: 'October',
                    value: '10'
                },
                {
                    name: 'November',
                    value: '11'
                },
                {
                    name: 'December',
                    value: '12'
                }],
                populateDate: [],
                populateYear: [],
                mobile_number: '',
                first_name: '',
                last_name: '',
                month: '',
                date: '',
                year: '',
                gender: '',
                email: '',
                errors: {},
                registerSuccess: false
            }
        },
        methods: {
            getDate() {
                for (var i = 1; i < 32; i++) {
                    if (i < 10) {
                        this.populateDate.push('0' + i)
                    } else {
                        this.populateDate.push(i)
                    }
                    
                }
            },
            getYear() {
                for (var i = 1950; i < 2051; i++) {
                    this.populateYear.push(i)
                }
            },
            registerUser() {
                this.errors = {}

                axios.post(this.registerUrl, {
                    mobile_number: this.mobile_number,
                    first_name: this.first_name,
                    last_name: this.last_name,
                    date_of_birth: this.year + '/' + this.month + '/' + this.date,
                    gender: this.gender,
                    email: this.email
                }).then(response => {
                    this.registerSuccess = response.data.success
                    if (response.data.success) {
                        this.resetForm()
                        console.log(response.data.message)

                    } else {
                        console.log(response.data.message)
                    }
                }).catch(err => {
                    if (err.response.status == 422){
                       this.errors = err.response.data.errors;
                    } else {
                        console.log(this.errors)
                    }

                    this.registerSuccess = false
                })
            },
            resetForm() {
                this.mobile_number = ''
                this.first_name = ''
                this.last_name = ''
                this.month = ''
                this.date = ''
                this.year = ''
                this.gender = ''
                this.email = ''
            },
            goToLogin() {
                window.location.href = this.loginUrl
            }

        }
    }
</script>

<style type="text/css">
    .tooltip-wrapper {
        position: relative;
    }

    .custom-tooltip {
        position: absolute;
        top: -55px;
        right: 0;
        background: red;
        border: 1px solid black;
        border-radius: 4px;
        padding: 10px;
        color: #fff;
        font-weight: 600;
    }

    .custom-tooltip.dob {
        min-width: 200px;
        top: -78px;
    }

    .custom-tooltip:after {
        content: '';
        width: 0px;
        height: 0px;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-top: 12px solid #f00;
        position: absolute;
        bottom: -12px;
        right:80px;
    }

    .bg-lightgray {
        background-color: lightgray;
    }

    .white-overlay {
        position: absolute;
        top:0;
        left:0;
        right:0;
        bottom:0;
        background-color: #fff;
        z-index: 2;
        opacity: .5;
    }

    .blue-violet {
        background-color: blueviolet;
        color:#fff;
        font-weight: 900;
    }
</style>