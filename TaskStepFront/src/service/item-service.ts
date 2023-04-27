import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Item } from '../app/model/item';
import { Observable, throwError, catchError, of, tap, from} from 'rxjs';

@Injectable({
  providedIn: 'root',
})

export class ItemService {

    constructor(private httpClient: HttpClient) {}



    
    private log(reponse : Item[]|Item|undefined){
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
  