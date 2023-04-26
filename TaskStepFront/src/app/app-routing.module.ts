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
import { AdditemComponent } from './additem/additem.component';
import { AuthGuard } from './auth.guard';

const routes: Routes = [
  {path : '', redirectTo: '/register', pathMatch: 'full'},
  {path : 'login', component: LoginComponent},
  {path : 'index', component: IndexComponent, canActivate:[AuthGuard]},
  {path : 'settings', component: SettingsComponent, canActivate:[AuthGuard]},
  {path : 'changePassword', component: ChangePasswordComponent, canActivate:[AuthGuard]},
  {path : 'bycontext', component: BycontextComponent, canActivate:[AuthGuard]},
  {path : "addcontext", component: AddcontextComponent, canActivate:[AuthGuard]},
  {path : "editcontext", component: EditcontextComponent, canActivate:[AuthGuard]},
  {path : 'byproject', component: ByprojectComponent, canActivate:[AuthGuard]},
  {path : "addproject", component: AddprojectComponent, canActivate:[AuthGuard]},
  {path : "editproject", component: EditprojectComponent, canActivate:[AuthGuard]},
  {path : 'additem', component: AdditemComponent, canActivate:[AuthGuard]},
  {path : "register", component:RegisterComponent},
  {path : '**', component: PagenotfoundComponent, canActivate:[AuthGuard] },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
