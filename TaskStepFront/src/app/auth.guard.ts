import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, RouterStateSnapshot, UrlTree, Router } from '@angular/router';
import { Observable } from 'rxjs';
import { AuthService } from 'src/service/auth-service';

@Injectable({
  providedIn: 'root'
})
export class AuthGuard implements CanActivate {

  constructor(public router: Router){

  }

  /**
   * Look if the user can to the page if connected or not
   * @param route 
   * @param state 
   * @returns 
   */
  canActivate(
    route: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {

    if (sessionStorage.getItem("token") != "" || sessionStorage.getItem != null){
      // Get the last saved token
      AuthService.token = String(sessionStorage.getItem("token"));
      return true;
    }
    else {
      this.router.navigate(["register"])
      return false;
    }


  }
  
}
