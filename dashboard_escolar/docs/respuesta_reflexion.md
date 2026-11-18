# Pregunta de reflexión

**¿Qué ventaja tendría desactivar un servicio en lugar de borrar su fila para siempre?**

Desactivar un servicio (`activo = 0`) en lugar de borrarlo conserva su información y su historial en la base de datos. Si después se necesita nuevamente, puede reactivarse sin crear el registro otra vez, y se evita la pérdida permanente de datos. Por ejemplo, Biblioteca seguiría guardada, pero el sistema dejaría de mostrarla a los alumnos.
