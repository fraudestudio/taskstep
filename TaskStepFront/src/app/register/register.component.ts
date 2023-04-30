import { AfterViewInit, Component } from '@angular/core';
import { FakeDatabase } from '../model/FakeDatabase';
import { ReCaptchaV3Service } from 'ng-recaptcha';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { AuthService } from 'src/service/auth-service';
import { HttpClient } from '@angular/common/http';


@Component({
  selector: 'app-register',
  templateUrl: 'register.component.html'
})
export class RegisterComponent {

  constructor(private recaptchaV3Service: ReCaptchaV3Service, private route: ActivatedRoute,  private router: Router, private httpClient : HttpClient){
    this.authService = new AuthService(httpClient);
  }


  /**
   * Communication to the api with the auth service
   */
  private authService : AuthService;

  /**
  * Information of the form
  */
  form : any  = {
      mail : null,
      password : null,
      confirmPassword : null,
  };
  
  /**
   * Check if the confirmed password if the same that the password
   * @returns the result of the verification
   */
  isPasswordCorrect() : boolean{
    return this.form.password == this.form.confirmPassword;
  }

  /**
   * When submit, the captcha sent a token and create an account
   */
  submit(){
    this.recaptchaV3Service.execute('importantAction')
    .subscribe((token: string) => {
      console.log(token);
      //FakeDatabase.AddUser(this.form.mail, this.form.password);
      
      this.authService.signup(this.form.mail, this.form.password,token).subscribe((data => {
        if (data != null) {
          this.router.navigate(["login"], {state : {data : { message : "Votre compte a bien été créer ! Vous pouvez maintenant vous connectez.", type : "confirmation"}}})
        }
        else {
          
        }
      }))
    });

  }
}