import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { Item } from '../app/model/item';
import { Observable, throwError, catchError, of, tap, from} from 'rxjs';
import { AuthService } from './auth-service';
import { Router } from '@angular/router';

@Injectable({
  providedIn: 'root',
})

export class ItemService {

    constructor(private httpClient: HttpClient, private router : Router ) {}


    /**
     * Get all the item wanted
     * @param section the section wanted
     * @param sort the sort wanted
     * @returns 
     */
    getItemsSection(section : string, sort : string) : Observable<Item[]> {
        const httpOptions = {
        headers : new HttpHeaders({'Content-Type' : 'application/json',
            'Authorization': 'Bearer ' +  AuthService.token})
        };
        return this.httpClient.get<Item[]>("../api/items?section="+section+"&sort="+sort, httpOptions).pipe(
        tap((response) => console.table(response)),
        catchError((error) => this.handleError(error,[]))
        )
    }


    /**
     * Get all the item wanted
     * @param date the date wanted
     * @param sort the sort wanted
     * @returns 
     */
    getItemsDate(date : string, sort : string) : Observable<Item[]> {
        const httpOptions = {
        headers : new HttpHeaders({'Content-Type' : 'application/json',
            'Authorization': 'Bearer ' +  AuthService.token})
        };
        return this.httpClient.get<Item[]>("../api/items?date="+date+"&sort="+sort, httpOptions).pipe(
        tap((response) => console.table(response)),
        catchError((error) => this.handleError(error,[]))
      )
    }

    /**
     * Get all the item wanted
     * @param context the context wanted
     * @param sort the sort wanted
     * @returns 
     */
    getItemsContext(context : number, sort : string) : Observable<Item[]> {
      const httpOptions = {
      headers : new HttpHeaders({'Content-Type' : 'application/json',
          'Authorization': 'Bearer ' +  AuthService.token})
      };
      return this.httpClient.get<Item[]>("../api/items?context="+context+"&sort="+sort, httpOptions).pipe(
      tap((response) => console.table(response)),
      catchError((error) => this.handleError(error,[]))
    )
  }

    /**
     * Get all the item wanted
     * @param context the context wanted
     * @param sort the sort wanted
     * @returns 
     */
    getItemsProject(context : number, sort : string) : Observable<Item[]> {
      const httpOptions = {
      headers : new HttpHeaders({'Content-Type' : 'application/json',
          'Authorization': 'Bearer ' +  AuthService.token})
      };
      return this.httpClient.get<Item[]>("../api/items?project="+context+"&sort="+sort, httpOptions).pipe(
      tap((response) => console.table(response)),
      catchError((error) => this.handleError(error,[]))
    )
  }

    /**
     * Get all the item wanted
     * @returns 
    */
    getItemsAll(sort : string) : Observable<Item[]> {
      const httpOptions = {
        headers : new HttpHeaders({'Content-Type' : 'application/json',
          'Authorization': 'Bearer ' +  AuthService.token})
        };
        return this.httpClient.get<Item[]>("../api/items?sort="+sort, httpOptions).pipe(
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


    return this.httpClient.post("../api/items", {
      Title : item.Title,
      Date : item.Date,
      Notes : item.Notes,
      Url : item.Url,
      Done : item.Done,
      Context : {
        Id : item.Context.Id,
        Title : ""
      },
      Section : item.Section,
      Project : {
        Id : item.Project.Id,
        Title :""
      }
    } 
    ,httpOptions).pipe(
      tap((response) => console.table(response)),
      catchError((error) => this.handleError(error,null))
    )
  }

  /**
   * Get an item by it's id
   * @param id id of the item
   * @returns the item
   */
  getItem(id : number) : Observable<Item> {
    const httpOptions = {
      headers : new HttpHeaders({'Content-Type' : 'application/json',
      'Authorization': 'Bearer ' + AuthService.token})
    };
    return this.httpClient.get<Item>("../api/items/" + id, httpOptions).pipe(
      tap((response) => console.table(response)),
      catchError((error) => this.handleError(error,[]))
    )
  }

  /**
   * delete an item by it's id 
   * @param id id of the item
   * @returns null
   */
  deleteItem(id : number) : Observable<null> {
    const httpOptions = {
      headers : new HttpHeaders({'Content-Type' : 'application/json',
      'Authorization': 'Bearer ' + AuthService.token})
    };
    return this.httpClient.delete<Item>("../api/items/" + id, httpOptions).pipe(
      tap((response) => console.table(response)),
      catchError((error) => this.handleError(error,null))
    )
  }

  /**
   * Modify an item 
   * @param id of the item
   * @param title of the item 
   * @returns null
   */
  modifyItem(item : Item) : Observable<null> {
    const httpOptions = {
      headers : new HttpHeaders({'Content-Type' : 'application/json',
      'Authorization': 'Bearer ' + AuthService.token})
    };
    return this.httpClient.put("../api/items/" + item.Id, { 
      Title : item.Title,
      Date : item.Date,
      Notes : item.Notes,
      Url : item.Url,
      Done : item.Done,
      Context : {
        Id : item.Context.Id,
        Title : ""
      },
      Section : item.Section,
      Project : {
        Id : item.Project.Id,
        Title :""
      }
    }, httpOptions).pipe(
      tap((response) => console.table(response)),
      catchError((error) => this.handleError(error,null))
    )
  }

  /**
   * Get the number of task that are not done
   * @returns the number of task that are not done
   */
  getUndone() : Observable<number> {
    const httpOptions = {
      headers : new HttpHeaders({'Content-Type' : 'application/json',
      'Authorization': 'Bearer ' + AuthService.token})
    };
    return this.httpClient.get<number>("../api/items/count/undone", httpOptions).pipe(
      tap((response) => console.table(response)),
      catchError((error) => this.handleError(error,null))
    )
  }


  /**
   * Get all the done information the sections
   * @returns 
   */
  getDoneSection() {
    const httpOptions = {
      headers : new HttpHeaders({'Content-Type' : 'application/json',
      'Authorization': 'Bearer ' + AuthService.token})
    };
    return this.httpClient.get("../api/items/count/by-section", httpOptions).pipe(
      tap((response) => console.table(response)),
      catchError((error) => this.handleError(error,null))
    )
  }

  /**
   * Get token for print and csv
   * @returns 
   */
  getToken() : Observable<null>{
      const httpOptions = {
        headers : new HttpHeaders({'Content-Type' : 'text/plain',
        'Authorization': 'Bearer ' + AuthService.token}),
        responseType: 'text' as 'json'
      };
      return this.httpClient.get("../api/account/export", httpOptions ).pipe(
        tap((response) => console.table(response)),
        catchError((error) => this.handleError(error,null))
      )
  }

  /**
   * Print all the item
   * @returns 
   */
  printAll() {
    this.getToken().subscribe((data) => {
      window.location.href = "../print.php?print=all&user=" + data;
    });
  }

  /**
   * Print a section
   * @param section section to print
   * @returns 
   */
  printSection(section : string) {
    this.getToken().subscribe((data) => {
      window.location.href = "../print.php?print=section&section=" + section +"&user=" + data;
    });
  }

  /**
   * Print the today section
   * @returns 
   */
  printToday(){
    this.getToken().subscribe((data) => {
      window.location.href = "../print.php?print=today&user=" + data;
    });
  }

  /**
   * Print the given context
   * @param id if of the context
   * @returns 
   */
  printContext(id : number){
    this.getToken().subscribe((data) => {
      window.location.href = "../print.php?print=context&tid="+id+"&user=" + data;
    });
  }
  
  /**
   * Print the given project
   * @param id if of the context
   * @returns 
   */
  printProject(id : number){
    this.getToken().subscribe((data) => {
      window.location.href = "../print.php?print=project&tid="+id+"&user=" + data;
    });
  }

  getCSV(){
    this.getToken().subscribe((data) => {
      window.location.href = "../export.php?user="+data;
    });
  }

  /**
   * Get the item of today and before today
   * @returns 
   */
  getItemBeforeToday(date : string) : Observable<Item[]>{
    const httpOptions = {
      headers : new HttpHeaders({'Content-Type' : 'application/json',
      'Authorization': 'Bearer ' + AuthService.token})
    };
    return this.httpClient.get<Item[]>("../api/items/daily/"+date, httpOptions).pipe(
      tap((response) => console.table(response)),
      catchError((error) => this.handleError(error,null))
    )        
  }

  /**
   * Delete all the done items
   * @returns 
   */
  deleteDoneItem() : Observable<number>{
    const httpOptions = {
      headers : new HttpHeaders({'Content-Type' : 'application/json',
      'Authorization': 'Bearer ' + AuthService.token})
    };
    return this.httpClient.delete<number>("../api/items/done", httpOptions).pipe(
      tap((response) => console.table(response)),
      catchError((error) => this.handleError(error,null))
    )    
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
  