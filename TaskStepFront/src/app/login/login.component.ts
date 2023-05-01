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
   * Get if an error as to be shown
   */
    get HasError() : boolean{
      return this.hasError;
    } 

  /**
   * Check if the user is log in
   * @param route 
   * @param router 
   */
  constructor(private route: ActivatedRoute,  private router: Router, private httpClient : HttpClient) {
    this.authService = new AuthService(httpClient);
  }

  /**
   * Communication with the api thanks to AuthService
   */
  private authService : AuthService;
  
  /**
   * Information of the form
   */
  form : any  = {
    email : null,
    password : null
  };


  /**
   * Message to display if there is one
   */
  get message() : string {
    return history.state.data?.message; 
  }


  /**
   * Type of the message to display if there is one
   */
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
        sessionStorage.setItem("mail",data.User.Email);
        sessionStorage.setItem("isCheckedDisplay", String(data.User.Settings.Tips));
        this.router.navigate(['index']);
        console.log(AuthService.token);
      }
      else {
        this.hasError = true;
      }
    });

  } 
  

}
