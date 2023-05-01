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

    /**
     * Update the settings of the user
     * @param theme theme of the user
     * @param tips tips of the user
     * @returns 
     */
    updateSettings(theme : string, tips : boolean) : Observable<null>{
        const httpOptions = {
        headers : new HttpHeaders({'Content-Type' : 'application/json',
            'Authorization': 'Bearer ' + AuthService.token})
        };

        return this.httpClient.put("api/account/settings", { Style : theme, Tips : tips },httpOptions).pipe(
            tap((response) => console.table(response)),
            catchError((error) => this.handleError(error,null))
        )
    }


    updatePassword(password : string,newPassword : string){
        const httpOption = {
            headers : new HttpHeaders({'Content-Type' : 'text/plain',
            'Authorization':'Basic ' + Buffer.from(sessionStorage.getItem("mail") + ':' + password).toString('base64')
            }) 
        };

        return this.httpClient.put("api/account/password", newPassword, httpOption).pipe(
            tap((response) => console.table(response)),
            catchError((error) => of(false))
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
  