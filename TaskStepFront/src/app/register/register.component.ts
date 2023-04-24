import { AfterViewInit, Component, OnInit, ViewChild } from '@angular/core';
import { FakeDatabase } from '../model/FakeDatabase';
import { RecaptchaModule, RecaptchaFormsModule } from "ng-recaptcha";

@Component({
  selector: 'app-register',
  templateUrl: 'register.component.html'
})
export class RegisterComponent implements AfterViewInit{

  constructor(){

  }

  @ViewChild('recaptcha') captchaRef: any;

  ngAfterViewInit(): void {

  }

  /**
  * Information of the form
  */
  form : any  = {
      username : null,
      mail : null,
      password : null,
      confirmPassword : null,
      captcha : null
  };
  
  isCaptchaCorrect() {
    console.log(this.captchaRef);
    return this.captchaRef?.resolved;
  }

  captchaCorrect(event : any){
    console.log(event);
    this.form.captcha = true;
  }


  isPasswordCorrect() : boolean{
    return this.form.password == this.form.confirmPassword;
  }

  submit(){
    FakeDatabase.AddUser(this.form.username,this.form.mail, this.form.password);
  }
}