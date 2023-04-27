import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Context } from '../app/model/context';
import { Observable, throwError, catchError, of, tap} from 'rxjs';

@Injectable({
  providedIn: 'root',
})

export class ContextService {

  constructor(private httpClient: HttpClient) {}

  /**
   * Get all the contexts of the user
   * @returns the contexts of the user
   */
  getContexts() : Observable<Context[]> {
    return this.httpClient.get<Context[]>("api/contexts").pipe(
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
      headers : new HttpHeaders({'Content-Type' : 'application/json'})
    };

    return this.httpClient.post("api/contexts", { Title : title },httpOptions).pipe(
      tap((response) => console.table(response)),
      catchError((error) => this.handleError(error,null))
    )
  }

  /**
   * Get a context by it's id
   * @param id id of the project
   * @returns the project
   */
  getContext(id : number) : Observable<Context> {
    return this.httpClient.get<Context>("api/contexts/" + id).pipe(
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
    return this.httpClient.delete<Context>("api/contexts/" + id).pipe(
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
    return this.httpClient.put<Context>("api/contexts/" + id, { Title : title}).pipe(
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
  private handleError(error : Error, errorValue : any){
    console.error(error);
    return of(errorValue);
  }
}
  