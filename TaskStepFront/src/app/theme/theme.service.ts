import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class ThemeService {

  /**
   * Set a theme
   * @param theme Theme to set 
   */
  public static setTheme(theme: string) {
    const body = document.getElementsByTagName('body')[0];
    body.setAttribute('data-theme', theme);
    localStorage.setItem("theme", theme);
  }

  /**
   * Get the stored theme
   * @returns the stored theme
   */
  public static getStoredTheme(): string {
    return localStorage.getItem("theme") || 'classic';
  }

  /** 
   * Set the theme if no theme is saved
  */
  public static setInitialTheme() {
    const storedTheme = this.getStoredTheme();
    this.setTheme(storedTheme);
  }
}