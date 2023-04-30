import { Component, OnInit } from '@angular/core';
import { FakeDatabase } from '../model/FakeDatabase';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';

@Component({
  selector: 'app-change-password',
  templateUrl: 'change-password.component.html'
})
export class ChangePasswordComponent {

  constructor(private route: ActivatedRoute,  private router: Router){
    this.currentPassword = "";//FakeDatabase.GetPassword(String(sessionStorage.getItem("User")));
  }

  private currentPassword : string;

  /**
   * Tell if there is an error
   */
  private hasError : boolean = false;

  get HasError() : boolean{
    return this.hasError;
  }

  /**
   * Information of the form
  */
  form : any  = {
    password1 : null,
    password2 : null
  };
  

  isPasswordCorrect() {
    return this.form.password1 == this.currentPassword;
  }

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
  
  submit(){
    if (this.isPasswordCorrect()){
      //FakeDatabase.ChangePassword(String(sessionStorage.getItem("User")),this.form.password2)
      this.router.navigate(['settings'],{state : {data : { message : "Votre mot de passe a bien été modifier.", type : "confirmation"}}}); 
    }
    else {
      this.hasError = true;
    }

  }
}
