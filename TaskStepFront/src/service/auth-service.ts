import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { SignInModel } from './model/signin-model';
import { Observable, throwError, catchError, of, tap, from} from 'rxjs';
import { User } from 'src/app/model/user';
import { Buffer } from 'buffer'

@Injectable({
  providedIn: 'root',
})

export class AuthService {

    constructor(private httpClient: HttpClient) {}

    static token : string = "";

    /**
     * Sign in a user
     * @param email the email of the user
     * @param password the password of the user
     * @returns the token of the user
     */
    signin(email : string, password : string) : Observable<SignInModel> {
        const httpOptions = {
                headers : new HttpHeaders({
                'Authorization':'Basic ' + Buffer.from(email + ':' + password).toString('base64')
            })
        };

        return this.httpClient.post<SignInModel>("api/signin",{},httpOptions).pipe(
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

        return this.httpClient.post("api/signup", { Email : email, Password : password, CaptchaToken : token },httpOptions).pipe(
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
    private handleError(error : HttpErrorResponse, errorValue : any){
        console.error(error);
        return of(errorValue);
    }
}
  