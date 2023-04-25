import { Component } from '@angular/core';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';

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
  constructor(private route: ActivatedRoute,  private router: Router) {
    if (sessionStorage.getItem("login") == "true"){
      //this.router.navigate(['index']);
    }
  }
  
  /**
   * Information of the form
   */
  form : any  = {
    password : null
  };

  /**
   * Get if an error as to be shown
   */
  get HasError() : boolean{
    return this.hasError;
  } 

  /**
   * When the connexion button is it
   * if the password is good, we go to the index
   * Else we show an error
   */
  submit(){
    // Temporaire
    if (this.form.password == "taskstep"){
      this.router.navigate(['index']);
      sessionStorage.setItem("login","true");
    } 
    else {
      this.hasError = true;
    }
  }
  

}
