import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Project } from '../app/model/project';
import { Observable, throwError, catchError, of, tap} from 'rxjs';

@Injectable({
  providedIn: 'root',
})

export class ProjectService {

  constructor(private httpClient: HttpClient) {}

  /**
   * Get all the projects of the user
   * @returns the projects of the user
   */
  getProjects() : Observable<Project[]> {
    return this.httpClient.get<Project[]>("api/projects").pipe(
      tap((response) => console.table(response)),
      catchError((error) => this.handleError(error,[]))
    )
  }


  /**
   * add a project for a user
   * @param title title of the project
   * @returns null
   */
  addProject(title : string) : Observable<null> {
    const httpOptions = {
      headers : new HttpHeaders({'Content-Type' : 'application/json'})
    };

    return this.httpClient.post("api/projects", { Title : title },httpOptions).pipe(
      tap((response) => console.table(response)),
      catchError((error) => this.handleError(error,null))
    )
  }

  /**
   * Get a project by it's id
   * @param id id of the project
   * @returns the project
   */
  getProject(id : number) : Observable<Project> {
    return this.httpClient.get<Project>("api/projects/" + id).pipe(
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
    return this.httpClient.delete<Project>("api/projects/" + id).pipe(
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
    return this.httpClient.put<Project>("api/projects/" + id, { Title : title}).pipe(
      tap((response) => console.table(response)),
      catchError((error) => this.handleError(error,null))
    )
  }

  private log(reponse : Project[]|Project|undefined){
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
  