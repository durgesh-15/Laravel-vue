 <template>
 <div>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark p-3">
        <div class="container-fluid">
            <ul class="navbar-nav">
            <li class="nav-item">
                <router-link class="nav-link active" to="/"><h4>Home</h4></router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link active" to="/login"><h4>Login</h4></router-link>
            </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card shadow">
                    <div class="card-title text-center border-bottom">
                        <h2 class="p-3">Login</h2>
                    </div>
                    <div class="card-body">
                        <form>
                        <div class="mb-4">
                            <label for="username" class="form-label">Username/Email</label>
                            <input type="text" class="form-control" id="username" v-model="email" placeholder="Enter email"/>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" v-model="password" id="password" placeholder="Enter password"/>
                        </div>
                        <div class="mb-4">
                            <input type="checkbox" class="form-check-input" id="remember" />
                            <label for="remember" class="form-label">Remember Me</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" @click="login" class="btn text-light main-bg">Login</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>  
 </div>  
 </template>
 <script>
  export default {
      data(){
          return {
              email: '',
              password: ''
          }
      },
      methods:{
          login: function(){
            axios.post('api/login',{ 'email':this.email, 'password':this.password})
            .then(res => {
                if(res.data.token)
                {
                  localStorage.setItem('token',res.data.token)
                  this.$router.push('/admin')
                  .then(res => console.log('LoggedIn Successfully'))
                  .catch(err => console.log(err))
                }               
            })
            .catch(err => console.log(err))
          }
      }
    
  }
</script>