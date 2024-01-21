import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PsdlInformation9Component } from './psdl-information-9.component';

describe('PsdlInformation9Component', () => {
  let component: PsdlInformation9Component;
  let fixture: ComponentFixture<PsdlInformation9Component>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [PsdlInformation9Component],
    }).compileComponents();

    fixture = TestBed.createComponent(PsdlInformation9Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
