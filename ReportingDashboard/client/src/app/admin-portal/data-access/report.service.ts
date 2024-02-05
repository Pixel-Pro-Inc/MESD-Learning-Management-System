import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root',
})
export class ReportService {
  constructor(private httpClient: HttpClient) {}

  getGrades() {
    return this.httpClient.get(environment.apiUrl + 'report/grades');
  }

  getUsers() {
    return this.httpClient.get(environment.apiUrl + 'report/users');
  }
}
