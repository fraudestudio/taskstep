import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Project } from './project';
import { Observable, throwError, catchError, of, tap} from 'rxjs';
@Injectable({
  providedIn: 'root',
})
export class ProjectDao {
  constructor(private httpClient: HttpClient) {}

  // HttpClient API get() method => Fetch employees list
  getProjects() : Observable<Project[]> {
    return this.httpClient.get<Project[]>("api/projects").pipe(
      tap((response) => console.table(response)),
      catchError((error) => this.handleError(error,[]))
    )
  }

  private log(reponse : Project[]|Project|undefined){
    console.table(reponse);
  }

  private handleError(error : Error, errorValue : any){
    console.error(error);
    return of(errorValue);
  }
}
  