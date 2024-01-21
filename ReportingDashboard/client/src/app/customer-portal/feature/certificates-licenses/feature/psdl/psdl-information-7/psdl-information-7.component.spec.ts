import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PsdlInformation7Component } from './psdl-information-7.component';

describe('PsdlInformation7Component', () => {
  let component: PsdlInformation7Component;
  let fixture: ComponentFixture<PsdlInformation7Component>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [PsdlInformation7Component],
    }).compileComponents();

    fixture = TestBed.createComponent(PsdlInformation7Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
