import { Component } from '@angular/core';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl :"login.component.html"
})
export class LoginComponent {
  
  private hasError : boolean = false;

  constructor(
    private route: ActivatedRoute,
    private router: Router) {}
  

  form : any  = {
    password : null
  };


  get HasError() : boolean{
    return this.hasError;
  } 

  submit(){
    // Temporaire
    if (this.form.password == "taskstep"){
      this.router.navigate(['index']);
    } 
    else {
      this.hasError = true;
    }
  }
  

}
