import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { Router } from '@angular/router';
import { Context } from '../app/model/context';
import { Item } from '../app/model/item';
import { Observable, throwError, catchError, of, tap} from 'rxjs';
import { AuthService } from './auth-service';

@Injectable({
  providedIn: 'root',
})

export class ContextService {

  constructor(private httpClient: HttpClient, private router : Router ) {}

  /**
   * Get all the contexts of the user
   * @returns the contexts of the user
   */
  getContexts() : Observable<Context[]> {
    const httpOptions = {
      headers : new HttpHeaders({'Content-Type' : 'application/json',
      'Authorization': 'Bearer ' + AuthService.token})
    };
    return this.httpClient.get<Context[]>("api/contexts", httpOptions).pipe(
      tap((response) => console.table(response)),
      catchError((error) => this.handleError(error,[]))
    )
  }


  /**
   * add a context for a user
   * @param title title of the project
   * @returns null
   */
  addContext(title : string) : Observable<null> {
    const httpOptions = {
      headers : new HttpHeaders({'Content-Type' : 'application/json',
      'Authorization': 'Bearer ' + AuthService.token})
    };

    return this.httpClient.post("api/contexts", { Title : title },httpOptions).pipe(
      tap((response) => console.table(response)),
      catchError((error) => this.handleError(error,null))
    )
  }

  /**
   * Get a context by it's id
   * @param id id of the project
   * 
   * @returns the project
   */
  getContext(id : number) : Observable<Context> {
    const httpOptions = {
      headers : new HttpHeaders({'Content-Type' : 'application/json',
      'Authorization': 'Bearer ' + AuthService.token})
    };
    return this.httpClient.get<Context>("api/contexts/" + id, httpOptions).pipe(
      tap((response) => console.table(response)),
      catchError((error) => this.handleError(error,[]))
    )
  }

  /**
   * delete a context by it's id 
   * @param id id of the project
   * @returns null
   */
  deleteContext(id : number) : Observable<null> {
    const httpOptions = {
      headers : new HttpHeaders({'Content-Type' : 'application/json',
      'Authorization': 'Bearer ' + AuthService.token})
    };
    return this.httpClient.delete<Context>("api/contexts/" + id,httpOptions).pipe(
      tap((response) => console.table(response)),
      catchError((error) => this.handleError(error,null))
    )
  }

  /**
   * Modify a context 
   * @param id of the project
   * @param title of the project 
   * @returns null
   */
  modifyContext(id : number, title : string) : Observable<null> {
    const httpOptions = {
      headers : new HttpHeaders({'Content-Type' : 'application/json',
      'Authorization': 'Bearer ' + AuthService.token})
    };
    return this.httpClient.put<Context>("api/contexts/" + id, { Title : title}, httpOptions).pipe(
      tap((response) => console.table(response)),
      catchError((error) => this.handleError(error,null))
    )
  }

  private log(reponse : Context[]|Context|undefined){
    console.table(reponse);
  }


  /**
   * print the error in the console
   * @param error the error
   * @param errorValue the value of the error
   * @returns table of the value of the error
   */
  private handleError(error : HttpErrorResponse, errorValue : any){
    if (error.status == 401) {
      AuthService.token = "";
      this.router.navigate(['register']);
    }
    console.error(error);
    return of(errorValue);
  }
}
  