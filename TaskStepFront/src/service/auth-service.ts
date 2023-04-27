import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Context } from '../app/model/context';
import { Observable, throwError, catchError, of, tap, from} from 'rxjs';

@Injectable({
  providedIn: 'root',
})

export class AuthService {

    constructor(private httpClient: HttpClient) {}

    static token : string;

    /**
     * add a context for a user
     * @param title title of the project
     * @returns null
    */
    connect(email : string, password : string) : Observable<string> {
        const httpOptions = {
                headers : new HttpHeaders({'Content-Type' : 'application/json',
                'Authorization':'Basic'+btoa(email+':'+password)
            })
        };

        return this.httpClient.post<string>("api/signin",httpOptions).pipe(
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
  