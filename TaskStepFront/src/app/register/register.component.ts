import { AfterViewInit, Component } from '@angular/core';
import { FakeDatabase } from '../model/FakeDatabase';
import { ReCaptchaV3Service } from 'ng-recaptcha';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';


@Component({
  selector: 'app-register',
  templateUrl: 'register.component.html'
})
export class RegisterComponent implements AfterViewInit{

  constructor(private recaptchaV3Service: ReCaptchaV3Service, private route: ActivatedRoute,  private router: Router){

  }

  ngAfterViewInit(): void {

  }

  /**
  * Information of the form
  */
  form : any  = {
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
      console.log(token);
      FakeDatabase.AddUser(this.form.username,this.form.mail, this.form.password);
      this.router.navigate(["login"])
    });

  }
}