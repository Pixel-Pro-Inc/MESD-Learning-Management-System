import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CertificatesLicensesComponent } from './certificates-licenses.component';

describe('CertificatesLicensesComponent', () => {
  let component: CertificatesLicensesComponent;
  let fixture: ComponentFixture<CertificatesLicensesComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CertificatesLicensesComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(CertificatesLicensesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
