import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { IndexComponent } from './index/index.component';
import { LoginComponent } from './login/login.component';
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

const routes: Routes = [
  {path : '', redirectTo: '/login', pathMatch: 'full'},
  {path : 'login', component: LoginComponent},
  {path : 'index', component: IndexComponent},
  {path : 'settings', component: SettingsComponent},
  {path : 'changePassword', component: ChangePasswordComponent},
  {path : 'bycontext', component: BycontextComponent},
  {path : "addcontext", component: AddcontextComponent},
  {path : "editcontext", component: EditcontextComponent},
  {path : 'byproject', component: ByprojectComponent},
  {path : "addproject", component: AddprojectComponent},
  {path : "editproject", component: EditprojectComponent},
  {path : "register", component:RegisterComponent},
  {path : '**', component: PagenotfoundComponent },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
