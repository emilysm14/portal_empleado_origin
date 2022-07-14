from ast import If


print("Gracias por tu colaboracion,POr favor digite los siguientes datos")

edad=int(input("Digite sue edad"))
peso=float(input("Digite su peso"))
sexo=int(input("Digite su sexo"))
hemo=float(input("Digite su hemoglobina"))
pulso=int(input("Digite su pulso"))

if(edad>=18 and edad <=65):
   if(peso>50):
    if(sexo == "M" and hemo > 12.5):
        if(sexo == "F" and hemo > 13.5) :
           if (pulso>=50 and pulso<=110):
                print("El paciente puede donar")
            print("El paciente no puede donAR")   
        print("El paciente no puede donAR")       
    print("El paciente no puede donAR")