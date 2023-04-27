import { Component } from '@angular/core';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { AuthService } from "src/service/auth-service";
import { HttpClient } from '@angular/common/http';
import { ThemeService } from '../theme/theme.service';

@Component({
  selector: 'app-login',
  templateUrl :"login.component.html"
})
export class LoginComponent {
  
  private hasError : boolean = false;

  /**
   * Check if the user is log in
   * @param route 
   * @param router 
   */
  constructor(private route: ActivatedRoute,  private router: Router, private httpClient : HttpClient) {
    this.authService = new AuthService(httpClient);
  }

  private authService : AuthService;
  
  /**
   * Information of the form
   */
  form : any  = {
    email : null,
    password : null
  };

  /**
   * Get if an error as to be shown
   */
  get HasError() : boolean{
    return this.hasError;
  } 

  get message() : string {
    return history.state.data?.message; 
  }

  get type() : string {
    return history.state.data?.type;
  }

  /**
   * When the connexion button is it
   * if the password is good, we go to the index
   * Else we show an error
   */
  submit(){
    this.authService.signin(this.form.email,this.form.password).subscribe((data) => {
      if (data != null){
        AuthService.token = data.Token;
        sessionStorage.setItem("token",data.Token)
        ThemeService.setTheme(data.User.Settings.Style);
        sessionStorage.setItem("isCheckedDisplay", String(data.User.Settings.Tips));
        this.router.navigate(['index']);
      }
      else {
        this.hasError = true;
      }
    });
    console.log(AuthService.token);
  } 
  

}
