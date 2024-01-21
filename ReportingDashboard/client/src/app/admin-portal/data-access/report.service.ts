import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { map } from 'rxjs/operators';
import { CashierReportDto } from 'src/app/shared/models/cashier-report-dto';
import { DashboardDto } from 'src/app/shared/models/dashboard-dto';
import { DashboardRequestDto } from 'src/app/shared/models/dashboard-request-dto';
import { ReportRequestDto } from 'src/app/shared/models/report-request-dto';
import { SmsReport } from 'src/app/shared/models/sms-report';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root',
})
export class ReportService {
  constructor(private httpClient: HttpClient) {}

  getDashboard(dashboardRequestDto: DashboardRequestDto) {
    return this.httpClient
      .post(environment.apiUrl + 'report/get-dashboard', dashboardRequestDto)
      .pipe(
        map((response: DashboardDto) => {
          return response;
        })
      );
  }

  getTimeSheets(reportRequestDto: ReportRequestDto) {
    return this.httpClient
      .post(environment.apiUrl + 'report/get-time-sheets', reportRequestDto)
      .pipe(
        map((response: any) => {
          return response;
        })
      );
  }

  getSalesReport(reportRequestDto: ReportRequestDto) {
    return this.httpClient
      .post(environment.apiUrl + 'report/get-sales-report', reportRequestDto)
      .pipe(
        map((response: any) => {
          return response;
        })
      );
  }

  getCancelledSalesReport(reportRequestDto: ReportRequestDto) {
    return this.httpClient
      .post(
        environment.apiUrl + 'report/get-cancelled-sales-report',
        reportRequestDto
      )
      .pipe(
        map((response: any) => {
          return response;
        })
      );
  }

  getCashierReport(reportRequestDto: ReportRequestDto) {
    return this.httpClient
      .post(environment.apiUrl + 'report/get-cashier-report', reportRequestDto)
      .pipe(
        map((response: CashierReportDto[]) => {
          return response;
        })
      );
  }

  getRevenueReport(reportRequestDto: ReportRequestDto) {
    return this.httpClient
      .post(environment.apiUrl + 'report/get-revenue-report', reportRequestDto)
      .pipe(
        map((response: any[]) => {
          return response;
        })
      );
  }

  getSmsReport(reportRequestDto: ReportRequestDto) {
    return this.httpClient
      .post(environment.apiUrl + 'report/get-sms-report', reportRequestDto)
      .pipe(
        map((response: SmsReport) => {
          return response;
        })
      );
  }
}
