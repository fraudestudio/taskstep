import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, throwError, catchError, of, tap, from} from 'rxjs';

@Injectable({
  providedIn: 'root',
})

export class AuthService {

    constructor(private httpClient: HttpClient) {}

    static token : string = "12345678901234567890";

    /**
     * Sign in a user
     * @param email the email of the user
     * @param password the password of the user
     * @returns the token of the user
     */
    signin(email : string, password : string) : Observable<string> {
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


    /**
     * Sign up a user
     * @param email the email of the user
     * @param password the password of the user
     * @param token the token of the captcha
     * @returns null
     */
    signup(email : string, password : string, token : string) : Observable<null> {
        const httpOptions = {
            headers : new HttpHeaders({'Content-Type' : 'application/json',
            })
        };

        return this.httpClient.post("api/signin", { Email : email, Password : password, Token : token },httpOptions).pipe(
            tap((response) => console.table(response)),
            catchError((error) => this.handleError(error,null))
        )
    }


    private log(reponse : any){
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
  