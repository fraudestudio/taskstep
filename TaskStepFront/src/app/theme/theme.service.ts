import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class ThemeService {

  public static setTheme(theme: string) {
    const body = document.getElementsByTagName('body')[0];
    body.setAttribute('data-theme', theme);
    localStorage.setItem("theme", theme);
  }

  public static getStoredTheme(): string {
    return localStorage.getItem("theme") || 'light';
  }

  public static setInitialTheme() {
    const storedTheme = this.getStoredTheme();
    this.setTheme(storedTheme);
  }
}