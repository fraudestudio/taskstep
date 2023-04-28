import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { Item } from '../app/model/item';
import { Observable, throwError, catchError, of, tap, from} from 'rxjs';
import { AuthService } from './auth-service';

@Injectable({
  providedIn: 'root',
})

export class ItemService {

    constructor(private httpClient: HttpClient) {}

    /**
    * Get all the item of the user
    * @returns the item of the user
    */
    getItems() : Observable<Item[]> {
        const httpOptions = {
        headers : new HttpHeaders({'Content-Type' : 'application/json',
            'Authorization': 'Bearer ' +  AuthService.token})
        };
        return this.httpClient.get<Item[]>("api/items", httpOptions).pipe(
        tap((response) => console.table(response)),
        catchError((error) => this.handleError(error,[]))
        )
    }


  /**
   * add an item for a user
   * @param item item to add
   * @returns null
   */
  addItem(item : Item) : Observable<null> {
    const httpOptions = {
      headers : new HttpHeaders({'Content-Type' : 'application/json',
      'Authorization': 'Bearer ' + AuthService.token})
    };
    return this.httpClient.post("api/projects", 
    { 
        Title : item.Title,
        Date : item.DueDate,
        Notes : item.Note,
        Url : item.Url,
        Done : item.Done,
        Context : {
            Title : item.Context
        },
        Section : item.Section,
        Project : {
          Title :item.Project
        }
    },httpOptions).pipe(
      tap((response) => console.table(response)),
      catchError((error) => this.handleError(error,null))
    )
  }

  /**
   * Get a project by it's id
   * @param id id of the project
   * @returns the project
   */
  getItem(id : number) : Observable<Item> {
    const httpOptions = {
      headers : new HttpHeaders({'Content-Type' : 'application/json',
      'Authorization': 'Bearer ' + AuthService.token})
    };
    return this.httpClient.get<Item>("api/projects/" + id, httpOptions).pipe(
      tap((response) => console.table(response)),
      catchError((error) => this.handleError(error,[]))
    )
  }

  /**
   * delete a project by it's id 
   * @param id id of the project
   * @returns null
   */
  deleteProject(id : number) : Observable<null> {
    const httpOptions = {
      headers : new HttpHeaders({'Content-Type' : 'application/json',
      'Authorization': 'Bearer ' + AuthService.token})
    };
    return this.httpClient.delete<Item>("api/projects/" + id, httpOptions).pipe(
      tap((response) => console.table(response)),
      catchError((error) => this.handleError(error,null))
    )
  }

  /**
   * Modify a project 
   * @param id of the project
   * @param title of the project 
   * @returns null
   */
  modifyProject(id : number, title : string) : Observable<null> {
    const httpOptions = {
      headers : new HttpHeaders({'Content-Type' : 'application/json',
      'Authorization': 'Bearer ' + AuthService.token})
    };
    return this.httpClient.put<Item>("api/projects/" + id, { Title : title}, httpOptions).pipe(
      tap((response) => console.table(response)),
      catchError((error) => this.handleError(error,null))
    )
  }


    
    private log(reponse : Item[]|Item|undefined){
        console.table(reponse);
    }


    /**
     * print the error in the console
     * @param error the error
     * @param errorValue the value of the error
     * @returns table of the value of the error
    */
    private handleError(error : HttpErrorResponse, errorValue : any){
        console.error(error);
        return of(errorValue);
    }
}
  