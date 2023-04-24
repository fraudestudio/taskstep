import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { NavigationBarComponent } from './navigation-bar/navigation-bar.component';
import { LoginComponent } from './login/login.component';
import { IndexComponent } from './index/index.component';
import { FooterComponent } from './footer/footer.component';
import { CommonModule } from '@angular/common';
import { registerLocaleData } from '@angular/common';
import localeFr from '@angular/common/locales/fr';
import { SettingsComponent } from './settings/settings.component';
import { ChangePasswordComponent } from './change-password/change-password.component';
import { PagenotfoundComponent } from './pagenotfound/pagenotfound.component';
import { BycontextComponent } from './bycontext/bycontext.component';
import { AddcontextComponent } from './addcontext/addcontext.component';
import { EditcontextComponent } from './editcontext/editcontext.component';
import { ByprojectComponent } from './byproject/byproject.component';
import { AddprojectComponent } from './addproject/addproject.component';
import { EditprojectComponent } from './editproject/editproject.component';
import { RegisterComponent } from './register/register.component';
import { FormsModule } from '@angular/forms';
import { RecaptchaV3Module, RECAPTCHA_V3_SITE_KEY } from 'ng-recaptcha';
import { environment } from 'src/environments/environment';

registerLocaleData(localeFr);

@NgModule({
  declarations: [
    AppComponent,
    NavigationBarComponent,
    LoginComponent,
    IndexComponent,
    FooterComponent,
    SettingsComponent,
    ChangePasswordComponent,
    PagenotfoundComponent,
    BycontextComponent,
    AddcontextComponent,
    EditcontextComponent,
    ByprojectComponent,
    AddprojectComponent,
    EditprojectComponent,
    RegisterComponent,

  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    CommonModule,
    RecaptchaV3Module
  ],
  providers: [{
      provide: RECAPTCHA_V3_SITE_KEY,
      useValue: environment.recaptcha.siteKey,
    }, 
  ],
  bootstrap: [AppComponent]
})



export class AppModule { }
