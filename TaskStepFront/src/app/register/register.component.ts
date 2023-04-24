import { AfterViewInit, Component } from '@angular/core';
import { FakeDatabase } from '../model/FakeDatabase';
import { ReCaptchaV3Service } from 'ng-recaptcha';


@Component({
  selector: 'app-register',
  templateUrl: 'register.component.html'
})
export class RegisterComponent implements AfterViewInit{

  constructor( private recaptchaV3Service: ReCaptchaV3Service){

  }

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
  

  isPasswordCorrect() : boolean{
    return this.form.password == this.form.confirmPassword;
  }

  submit(){
    this.recaptchaV3Service.execute('importantAction')
    .subscribe((token: string) => {
      console.debug(`Token [${token}] generated`);
      FakeDatabase.AddUser(this.form.username,this.form.mail, this.form.password);
    });

  }
}