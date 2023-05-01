import { Component, OnInit } from '@angular/core';
import { FakeDatabase } from '../model/FakeDatabase';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { AuthService } from 'src/service/auth-service';

@Component({
  selector: 'app-change-password',
  templateUrl: 'change-password.component.html'
})
export class ChangePasswordComponent {

  private authService : AuthService

  constructor(private route: ActivatedRoute,  private router: Router, private httpClient : HttpClient){
    this.authService = new AuthService(httpClient);
  }

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
    this.authService.updatePassword(this.form.password1,this.form.password2).subscribe((data) => {
      if (data != false){
        this.router.navigate(['settings'],{state : {data : { message : "Votre mot de passe a bien été modifier.", type : "confirmation"}}}); 
      }
      else {
        this.hasError = true;
      }
    })
  }
}
