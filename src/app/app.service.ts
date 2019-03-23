import { Injectable } from '@angular/core';

@Injectable({
    providedIn: 'root'
})
export class AppService
{
    private menuState: boolean = false;

    constructor()
    {
    }
}
