import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { IndexComponent } from './index/index.component';
import { LoginComponent } from './login/login.component';
import { SettingsComponent } from './settings/settings.component';
import { ChangePasswordComponent } from './change-password/change-password.component';
import { PagenotfoundComponent } from './pagenotfound/pagenotfound.component';

const routes: Routes = [
  {path : '', redirectTo: '/login', pathMatch: 'full'},
  {path : 'login', component: LoginComponent},
  {path : 'index', component: IndexComponent},
  {path : 'settings', component: SettingsComponent},
  {path : 'changePassword', component: ChangePasswordComponent},
  {path : '**', component: PagenotfoundComponent },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
