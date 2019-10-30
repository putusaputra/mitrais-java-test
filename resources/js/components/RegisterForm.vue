<template>
    <div class="row">
        <div class="title text-left col-md-8 mx-auto">
            <h1>Registration</h1>
        </div>
        <div class="form-wrapper col-md-8 mx-auto">
            <form @submit.prevent="registerUser">
                <div class="form-group">
                    <input type="text" class="form-control" name="mobile_number" v-model="mobile_number" placeholder="Mobile Number">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="first_name" v-model="first_name" placeholder="First Name">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="last_name" v-model="last_name" placeholder="Last Name">
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <select name="month" class="custom-select" v-model="month">
                            <option disabled readonly selected>Month</option>
                            <option v-for="monthVal in populateMonth" :key="monthVal.value" :value="monthVal.value">{{ monthVal.name }}</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="date" class="custom-select" v-model="date">
                            <option disabled readonly selected>Date</option>
                            <option v-for="dateVal in populateDate" :value="dateVal">{{ dateVal }}</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="year" class="custom-select" v-model="year">
                            <option disabled readonly selected>Year</option>
                            <option v-for="yearVal in populateYear" :value="yearVal">{{ yearVal }}</option>
                        </select>
                    </div>
                    
                    

                    
                </div>
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" v-model="gender" value="Male">
                        <label class="form-check-label">
                            Male
                        </label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" v-model="gender" value="Female">
                        <label class="form-check-label">
                            Female
                        </label>
                    </div>

                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="email" v-model="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary form-control" value="Register">
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['registerUrlVal'],
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
                populateMonth: [{
                    name: 'January',
                    value: 1
                },
                {
                    name: 'February',
                    value: 2
                },
                {
                    name: 'March',
                    value: 3
                },
                {
                    name: 'April',
                    value: 4
                },
                {
                    name: 'May',
                    value: 5
                },
                {
                    name: 'June',
                    value: 6
                },
                {
                    name: 'July',
                    value: 7
                },
                {
                    name: 'August',
                    value: 8
                },
                {
                    name: 'September',
                    value: 9
                },
                {
                    name: 'October',
                    value: 10
                },
                {
                    name: 'November',
                    value: 11
                },
                {
                    name: 'December',
                    value: 12
                }],
                populateDate: [],
                populateYear: [],
                mobile_number: '',
                first_name: '',
                last_name: '',
                month: 0,
                date: 0,
                year: 0,
                gender: '',
                email: ''
            }
        },
        methods: {
            getDate() {
                for (var i = 1; i < 32; i++) {
                    this.populateDate.push(i)
                }
            },
            getYear() {
                for (var i = 1950; i < 2051; i++) {
                    this.populateYear.push(i)
                }
            },
            registerUser() {
                axios.post(this.registerUrl, {
                    mobile_number: this.mobile_number,
                    first_name: this.first_name,
                    last_name: this.last_name,
                    date_of_birth: this.month + '/' + this.date + '/' + this.year,
                    
                    gender: this.gender,
                    email: this.email
                }).then(response => {
                    if (response.success) {
                        console.log(response.message)
                    } else {
                        console.log(response.message)
                    }
                }).catch(err => console.log(err))
            }

        }
    }
</script>